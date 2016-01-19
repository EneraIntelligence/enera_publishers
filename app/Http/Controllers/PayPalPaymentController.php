<?php

namespace Publishers\Http\Controllers;

use Illuminate\Support\Debug\Dumper;
use Input;
use Paypal;
use Illuminate\Http\Request;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;
use Publishers\Libraries\EneraTools;
use Publishers\Payment;
use Validator;

class PayPalPaymentController extends Controller
{
    private $_apiContext;

    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret')
        );

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => env('APP_ENV') == 'local' ? 'https://api.sandbox.paypal.com' : 'https://api.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

    public function index()
    {
        echo "<pre>";
        $payments = Paypal::getAll(array('count' => 1, 'start_index' => 0), $this->_apiContext);
        dd($payments);
    }

    public function getCheckout()
    {
        $validator = Validator::make(Input::all(), [
            "amount" => "required",
            "name" => "required",
            "address" => "required",
            "rfc" => "required|alpha_num",
            "country" => "required",
            "state" => "required",
            "city" => "required",
            "cp" => "required",
            "phone" => "required",
            "email" => "required|email",
        ]);
        if ($validator->passes()) {
            $money = EneraTools::Getfloat(Input::get('amount'));
            /* ADMIN PAYMENT */
            $admin_payment = auth()->user()->payments()->create([
                'amount' => $money,
                'type' => 'paypal',
                'status' => 'pending',
                'invoice' => [
                    'name' => Input::get('name'),
                    'address' => Input::get('address'),
                    'rfc' => Input::get('rfc'),
                    'state' => Input::get('state'),
                    'city' => Input::get('city'),
                    'cp' => Input::get('cp'),
                    'phone' => Input::get('phone'),
                    'email' => Input::get('email'),
                ],
                'paypal' => []
            ]);

            $admin_payment->history()->create([
                'status' => 'pending'
            ]);

            /* PAYPAL PAYMENT */
            $payer = PayPal::Payer();
            $payer->setPaymentMethod('paypal');

            $amount = PayPal::Amount();
            $amount->setCurrency('MXN');
            $amount->setTotal($money); // This is the simple way,
            // you can alternatively describe everything in the order separately;
            // Reference the PayPal PHP REST SDK for details.

            $transaction = PayPal::Transaction();
            $transaction->setAmount($amount);
            $transaction->setDescription('Enera Intelligence : Publishers');

            $redirectUrls = PayPal::RedirectUrls();
            $redirectUrls->setReturnUrl(route('budget::paypal.done', ['payment_id' => $admin_payment->_id]));
            $redirectUrls->setCancelUrl(route('budget::paypal.cancel', ['payment_id' => $admin_payment->_id]));

            $payment = PayPal::Payment();
            $payment->setIntent('sale');
            $payment->setPayer($payer);
            $payment->setRedirectUrls($redirectUrls);
            $payment->setTransactions(array($transaction));

            $response = $payment->create($this->_apiContext);
            $redirectUrl = $response->links[1]->href;

            return redirect()->to($redirectUrl);
        } else {
            return redirect()->route();
        }
    }

    /**
     * @param Request $request
     * @param $payment_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDone(Request $request, $payment_id)
    {
        $admin_payment = Payment::find($payment_id);
        if ($admin_payment && $admin_payment->status == 'pending') {
            /* PAYPAL PAYMENT */
            $id = $request->get('paymentId');
            $token = $request->get('token');
            $payer_id = $request->get('PayerID');

            $payment = PayPal::getById($id, $this->_apiContext);
            $paymentExecution = PayPal::PaymentExecution();
            $paymentExecution->setPayerId($payer_id);
            $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

            /* ADMIN MOVEMENT */
            $admin_balance = auth()->user()->wallet->current;

            $admin_payment->paypal = $this->object_to_array($executePayment);
            $admin_payment->save();

            $admin_payment->history()->create([
                'status' => 'done'
            ]);
            $admin_movement = auth()->user()->movements()->create([
                'client_id' => auth()->user()->client_id,
                'movement' => [
                    'type' => 'income',   //income, outcome
                    'concept' => 'deposit',
                    'from' => 'deposit',
                    'to' => 'wallet',
                ],
                'reference_id' => $payment_id,
                'reference_type' => 'Payment',
                'amount' => $admin_payment->amount,
                'balance' => ($admin_balance + $admin_payment->amount),
            ]);

            auth()->user()->wallet->increment('current', $admin_payment->amount);

//            dd($executePayment);

            // Thank the user for the purchase
            return redirect()->route('budget::index')->with([
                'n_type' => 'success',
                'n_msg' => 'Tu deposito fue recibido con exito!'
            ]);
        } else {
            return redirect()->route('budget::index')->with([
                'n_type' => 'danger',
                'n_msg' => 'El indentificador de pago es invalido.'
            ]);
        }
    }

    public function getCancel($payment_id)
    {
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        $admin_payment = Payment::find($payment_id);
        if ($admin_payment && $admin_payment->status == 'pending') {
            $admin_payment->status = 'canceled';
            $admin_payment->save();
            $admin_payment->history()->create([
                'status' => 'canceled',
                'msg' => 'cancelado desde paypal'
            ]);
            return redirect()->route('budget::index')->with([
                'n_type' => 'info',
                'n_msg' => 'Solicitud cancelada.'
            ]);
        } else {
            return redirect()->route('budget::index')->with([
                'n_type' => 'danger',
                'n_msg' => 'El indentificador de pago es invalido.'
            ]);
        }
    }

    protected function object_to_array($obj)
    {
        if (is_object($obj)) $obj = (array)$obj;
        if (is_array($obj)) {
            $new = array();
            foreach ($obj as $key => $val) {
                if (strpos($key, '_propMap') !== false) {
                    $new = $this->object_to_array($val);
                } else {
                    $new[$key] = $this->object_to_array($val);
                }
            }
        } else $new = $obj;
        return $new;
    }

}

