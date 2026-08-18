<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sandbox Mode
    |--------------------------------------------------------------------------
    */
    'sandbox' => env('SSLC_SANDBOX', true),

    /*
    |--------------------------------------------------------------------------
    | API Credentials
    |--------------------------------------------------------------------------
    */
    'store_id' => env('SSLC_STORE_ID'),
    'store_password' => env('SSLC_STORE_PASSWORD'),
    'currency' => env('SSLC_CURRENCY', 'BDT'),

    /*
    |--------------------------------------------------------------------------
    | API Endpoints (UPDATED TO V4)
    |--------------------------------------------------------------------------
    */
    'endpoints' => [
        'initiate' => [
            'sandbox' => 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php',
            'live' => 'https://securepay.sslcommerz.com/gwprocess/v4/api.php',
        ],
        'validate' => [
            'sandbox' => 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php',
            'live' => 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php',
        ],
        'refund' => [
            'sandbox' => 'https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php',
            'live' => 'https://securepay.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php',
        ],
        'query' => [
            'sandbox' => 'https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php',
            'live' => 'https://securepay.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Route Configuration
    |--------------------------------------------------------------------------
    */
    'routes' => [
        'prefix' => env('SSLC_ROUTE_PREFIX', 'sslcommerz'),
        'as' => env('SSLC_ROUTE_AS', 'sslcommerz.'),
        'success' => env('SSLC_ROUTE_SUCCESS', 'sslcommerz.success'),
        'failure' => env('SSLC_ROUTE_FAILURE', 'sslcommerz.failure'),
        'cancel' => env('SSLC_ROUTE_CANCEL', 'sslcommerz.cancel'),
        'ipn' => env('SSLC_ROUTE_IPN', 'sslcommerz.ipn'),
    ],
];