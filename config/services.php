<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_KEY'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model' => Publishers\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'paypal' => [
        'client_id' => env('PAYPAL_CLIENT_ID', 'AYKNLIuEO-vwphN3Yu8CnAqqSWfqKmyFkDqBOZAtxAuzCObxgSpePHm6Q-sw5rMNLaf2LIZE_FQXjoT2'),
        'secret' => env('PAYPAL_SECRET', 'EKqR0RH9x_yhGhtceaXCfW1c6jypg-qXSv9i8KvgYpY_GC221UdtzjH5i_FfWbszFrJRbsa-6oVOzEN9')
    ],

];
