<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
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

    'facebook' => [
        'client_id' => '298248714007195',
        'client_secret' => '43b29947a9248c10103afb2297144ea9',
        'redirect' => 'https://www.rdesurvey.com/auth/facebook/callback',
    ],

    'google' => [
            'client_id' => '383793175576-hbbg97h5crjpdicm9jab6e0k8agrt6s6.apps.googleusercontent.com',
            'client_secret' => 'p3Sin0JZIM7_MCpSW3mcLsct',
            'redirect' => 'https://www.rdesurvey.com/auth/google/callback',
    ],

    'twitter' => [
            'client_id' => 'PfoxU5467H5C45aEgeshA5TGV',
            'client_secret' => '8YYmX813XIdpIbgHNUVaS12egwJQQ87PuEbt69UIXxnU3MKPaC',
            'redirect' => 'https://www.rdesurvey.com/auth/twitter/callback',
    ],

];
