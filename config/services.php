<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'nowpayments' => [
        'enviroment' => env('NOWPAYMENTS_ENV'),

        'user' => env('NOWPAYMENTS_EMAIL'),
        'password'  => env('NOWPAYMENTS_PASSWORD'),

        'api_key'  => env('NOWPAYMENTS_API_KEY'),
        'ipn_key'  => env('NOWPAYMENTS_IPN_KEY'),
        'jwt_token'  => env('NOWPAYMENTS_JWT_TOKEN'),

        'api_key_dev'  => env('NOWPAYMENTS_API_KEY_DEV'),
        'ipn_key_dev'  => env('NOWPAYMENTS_IPN_KEY_DEV'),

        'callback_url'  => env('NOWPAYMENTS_CALLBACK_URL'),
    ],

];
