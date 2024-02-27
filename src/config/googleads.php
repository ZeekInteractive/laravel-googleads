<?php

return [
    'accounts' => [
        env('GOOGLE_ADS_CLIENT_CUSTOMER_ID') => [
            'developerToken' => env('GOOGLE_ADS_DEVELOPER_TOKEN'),
            'clientCustomerId' => env('GOOGLE_ADS_CLIENT_CUSTOMER_ID'),
            'loginCustomerId' => env('GOOGLE_ADS_LOGIN_CUSTOMER_ID'),
            'clientId' => env('GOOGLE_ADS_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_ADS_CLIENT_SECRET'),
            'refreshToken' => env('GOOGLE_ADS_REFRESH_TOKEN'),
        ],
    ],
];
