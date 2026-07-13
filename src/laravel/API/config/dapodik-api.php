<?php

return [
    'default' => env('DAPODIK_API_CONNECTION', 'authentication'),

    'connections' => [
        // Rest Connection
        'authentication' => [
            'host' => env('DAPODIK_API_HOST', 'http://localhost:5774'),
            'username' => env('DAPODIK_API_USERNAME', ''),
            'password' => env('DAPODIK_API_PASSWORD', ''),
            'kode_registrasi' => env('DAPODIK_API_KODE_REGISTRASI', ''),
            'driver' => 'rest',
        ],

        // WebService Connection
        'authorization' => [
            'host' => env('DAPODIK_API_HOST', 'http://localhost:5774'),
            'npsn' => env('DAPODIK_API_NPSN', ''),
            'token' => env('DAPODIK_API_TOKEN', ''),
            'driver' => 'webservice',
        ],
    ],
];
