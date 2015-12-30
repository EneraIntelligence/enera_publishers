<?php

namespace Publishers\Http\Controllers;

use Paypal;
use Illuminate\Http\Request;
use Publishers\Http\Requests;
use Publishers\Http\Controllers\Controller;

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
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
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
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $amount = PayPal:: Amount();
        $amount->setCurrency('MXN');
        $amount->setTotal(100); // This is the simple way,
        // you can alternatively describe everything in the order separately;
        // Reference the PayPal PHP REST SDK for details.

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Enera Intelligence');

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(action('PayPalPaymentController@getDone'));
        $redirectUrls->setCancelUrl(action('PayPalPaymentController@getCancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

//        dd($redirectUrl);

        return redirect()->to($redirectUrl);
    }

    public function getDone(Request $request)
    {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');

        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        // Clear the shopping cart, write to database, send notifications, etc.

        // Thank the user for the purchase
        return view('checkout.done');
    }

    public function getCancel()
    {
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        return view('checkout.cancel');
    }

}

