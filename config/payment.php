<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Payment gateways
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party payment gateways such
    | as hyperpay.
    */

    'url' => env('HYPERPAY_URL'),
    'auth_key' => env('HYPERPAY_AUTH_KEY'),
    'entity_id' => env('HYPERPAY_ENTITY_ID'),
    'test_url' => env('TEST_HYPERPAY_URL'),
    'test_auth_key' => env('TEST_HYPERPAY_AUTH_KEY'),
    'test_entity_id' => env('TEST_HYPERPAY_ENTITY_ID'),
    'production' => env('HYPERPAY_PRODUCTION'),
    'payment_gateway_type' => env('PAYMENT_GATEWAY_TYPE', 'rajhi_bank'),

];
