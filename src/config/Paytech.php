<?php

return [
    'api_key' => env('PAYTECH_API_KEY', ''),
    'api_secret' => env('PAYTECH_API_SECRET', ''),
    'env' => env('PAYTECH_ENV', 'test'),
    'ipn_url' => env('PAYTECH_IPN_URL', ''),
    'success_url' => env('PAYTECH_SUCCESS_URL', ''),
    'cancel_url' => env('PAYTECH_CANCEL_URL', ''),
];
