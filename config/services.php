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

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '437977808975-fau9nklivuki0869luo82sd0b62h1fnr.apps.googleusercontent.com',
        'client_secret' => 'ARDPAVQQaCCiU4Hl0vcwvMJo',
        'redirect' => 'http://localhost:80/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => '178620062633254',
        'client_secret' => 'd02c5da93284c3b0b8d550fa684ef39d',
        'redirect' => 'http://localhost:80/auth/facebook/callback'
    ]
];
