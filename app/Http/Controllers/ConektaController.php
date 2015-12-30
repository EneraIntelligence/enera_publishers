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

class ConektaController extends Controller
{
    /**
     *
     */
    public function conekta()
    {
//        require_once("/path/to/lib/Conekta.php");
        Conekta::setApiKey("key_YXGVyAwwMa3rXM3LRR53EQ");
        Conekta::setLocale('es');

        $charge = Conekta_Charge::create(array(
            'description'=> 'Deposito Enera Intelligence',
            'reference_id'=> 'Enera',
            'amount'=> Input::get('money'),
            'currency'=>'MXN',
            'card'=> 'tok_test_visa_4242',
            'details'=> array(
                'name'=> Input::get('name'),
                'phone'=> Input::get('phone'),
                'email'=> Input::get('email'),
                'customer'=> array(
                    'logged_in'=> true,
                    'successful_purchases'=> 14,
                    'created_at'=> new MongoDate(),
                    'updated_at'=> new MongoDate(),
                    'offline_payments'=> 4,
                    'score'=> 9
                ),
                'line_items'=> array(
                    array(
                        'name'=> 'Deposito',
                        'description'=> 'Abono a cuanta del cliente',
                        'unit_price'=> 100,
                        'quantity'=> Input::get('money'),
                        'sku'=> 'enera_1',
                        'category'=> 'servicio'
                    )
                ),
                'billing_address'=> array(
                    'street1'=> Input::get('address'),
                    'street2'=> null,
                    'street3'=> null,
                    'city'=> Input::get('city'),
                    'state'=>Input::get('state'),
                    'zip'=> Input::get('cp'),
                    'country'=> Input::get('country'),
                    'tax_id'=> Input::get('rfc'),
                    'company_name'=> Input::get('name'),
                    'phone'=> Input::get('phone'),
                    'email'=> Input::get('email')
                )
            )
        ));
//        echo $charge->payment_method->name;

        return view('budget.invoices', [$charge]);
    }
}
