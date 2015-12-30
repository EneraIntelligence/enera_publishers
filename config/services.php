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
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => Publishers\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'paypal' => [
        'client_id' => 'ARHP1JQkHYIDJhcVBeEL3pjEKlZ9HWDH0tEh1CMMllh5ox29P4r9-14P4myMvq08RoOu-5kKn7qv9Pzn',
        'secret'    => 'ENrYLz9PKE2SecCv2wnr2ib5GFn8bIrWnxLyMWOPCRvRBxHBOuNtnTkeECl6LGMmEuq6XoYKD9EwZ8-t'
    ],

];
