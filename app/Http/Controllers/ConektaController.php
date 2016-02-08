<?php

namespace Publishers\Http\Controllers;

use Auth;
use Conekta;
use Conekta_Charge;
use Illuminate\Http\Request;
use Input;
use Publishers\Http\Requests;
use MongoDate;
use Publishers\Http\Controllers\Controller;
use Publishers\Libraries\EneraTools;

class ConektaController extends Controller
{
    /**
     *
     */
    public function conekta()
    {
//        dd(str_replace('.', '0', EneraTools::Getfloat(Input::get('money'))). '00');
//        require_once("/path/to/lib/Conekta.php");
        Conekta::setApiKey("key_YXGVyAwwMa3rXM3LRR53EQ");
        Conekta::setLocale('es');

        $charge = Conekta_Charge::create(array(
            'description' => 'Deposito Enera Intelligence',
            'reference_id' => 'Enera',
            'amount' => str_replace('.', '0', EneraTools::Getfloat(Input::get('money'))) . '00',
            'currency' => 'MXN',
            'card' => 'tok_test_visa_4242',
            'details' => array(
                'name' => Input::get('name'),
                'phone' => Input::get('phone'),
                'email' => Input::get('email'),
                'customer' => array(
                    'logged_in' => true,
                    'successful_purchases' => 14,
                    'created_at' => new MongoDate(), //Cambiarlo por la fecha de ingreso el cliente
                    'updated_at' => new MongoDate(), //Cambiarlo por la fecha de actualiación el cliente
                    'offline_payments' => 4,
                    'score' => 9
                ),
                'line_items' => array(
                    array(
                        'name' => 'Deposito',
                        'description' => 'Abono a cuanta del cliente',
                        'unit_price' => 100,
                        'quantity' => Input::get('money'),
                        'sku' => 'enera_1',
                        'category' => 'servicio'
                    )
                ),
                'billing_address' => array(
                    'street1' => Input::get('address'),
                    'street2' => null,
                    'street3' => null,
                    'city' => Input::get('city'),
                    'state' => Input::get('state'),
                    'zip' => Input::get('cp'),
                    'country' => Input::get('country'),
                    'tax_id' => Input::get('rfc'),
                    'company_name' => Input::get('name'),
                    'phone' => Input::get('phone'),
                    'email' => Input::get('email')
                )
            )
        ));


        $payment = auth()->user()->payments()->create([
            'administrator_id' => auth()->user()->id,
            'amount' => EneraTools::Getfloat(Input::get('money')),
            'type' => 'conekta',
            'status' => 'done',
            'movement_id' => $charge->id,
            'invoice' => [
                'name' => $charge->details['name'],
                'address' => $charge->details['billing_address']->street1,
                'rfc' => $charge->details['billing_address']->tax_id,
                'state' => $charge->details['billing_address']->state,
                'city' => $charge->details['billing_address']->city,
                'cp' => $charge->details['billing_address']->zip,
                'phone' => $charge->details['phone'],
                'email' => $charge->details['email'],
            ],
            'conekta' => [
                'description' => 'Deposito Enera Intelligence',
                'reference_id' => 'Enera',
                'amount' => ($charge->amount / 100),
                'fee'    => ($charge->fee === 0)? '0': $charge->fee / 100,
                'billing_address' => array(
                    'address' => $charge->details['billing_address']->street1,
                    'city' => $charge->details['billing_address']->city,
                    'state' => $charge->details['billing_address']->state,
                    'zip' => $charge->details['billing_address']->zip,
                    'country' => $charge->details['billing_address']->country,
                    'rfc' => $charge->details['billing_address']->tax_id,
                    'company_name' => $charge->details['name'],
                    'phone' => $charge->details['phone'],
                    'email' => $charge->details['email'],
                )

            ],
            'history' => [
                'status' => 'done',
                'created_at' => new MongoDate(),
                'updated_at' => new MongoDate(),
            ]
        ]);
        //        admin movement

        $admin_movement = auth()->user()->movements()->create([
            'client_id' => auth()->user()->client_id,
            'movement' => [
                'type' => 'income',
                'concept' => 'deposit',
                'from' => 'deposit',
                'to' => 'wallet'
            ],
            'reference_id' => $payment->_id,
            'reference_type' => 'Payment',
            'admistrator_id' => auth()->user()->id,
            'amount' => EneraTools::Getfloat(Input::get('money')),
            'balance' => (auth()->user()->wallet->current + EneraTools::Getfloat(Input::get('money')))
        ]);

        auth()->user()->wallet->increment('current', EneraTools::Getfloat(Input::get('money')));

//        return view('budget.invoices', [$charge]);
        return redirect('budget');
    }
}
