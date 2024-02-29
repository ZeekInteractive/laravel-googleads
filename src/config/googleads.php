<?php

return [
    'accounts' => [
        env('GOOGLE_ADS_CLIENT_CUSTOMER_ID') => [

            /*
            |--------------------------------------------------------------------------
            | Google Ads Developer Token
            |--------------------------------------------------------------------------
            |
            | The developer token is a 22-character long alphanumeric string that lets
            | your app connect to the Google Ads API. This will require a Google Ads
            | Manager account. After the token is assigned to you by Google, you can
            | view it or create a new one on the API Center page of your Google Ads
            | manager account.
            |
            | @see https://developers.google.com/google-ads/api/docs/best-practices/test-accounts
            | @see https://developers.google.com/google-ads/api/docs/get-started/dev-token
            | @see https://support.google.com/google-ads/answer/7459399
            |
            */

            'developerToken' => env('GOOGLE_ADS_DEVELOPER_TOKEN'),

            /*
            |--------------------------------------------------------------------------
            | Client Customer ID
            |--------------------------------------------------------------------------
            |
            | This is the customer ID that will be used to identify the target account
            | for all API calls. It should be set without dashes, for example:
            | 1234567890 instead of 123-456-7890.
            |
            | @see https://developers.google.com/google-ads/api/docs/get-started/select-account
            | @see https://developers.google.com/google-ads/api/docs/best-practices/test-accounts
            |
            */

            'clientCustomerId' => env('GOOGLE_ADS_CLIENT_CUSTOMER_ID'),

            /*
            |--------------------------------------------------------------------------
            | Login Customer ID
            |--------------------------------------------------------------------------
            |
            | Required for manager accounts only. This is the login customer ID used to
            | authenticate API calls. This will be the customer ID of the authenticated
            | manager account. You can also specify this later in code if your
            | application uses multiple manager account + OAuth pairs. It should
            | be set without dashes, for example: 1234567890 instead of 123-456-7890.
            |
            */

            'loginCustomerId' => env('GOOGLE_ADS_LOGIN_CUSTOMER_ID'),

            /*
            |--------------------------------------------------------------------------
            | OAuth2 Credentials
            |--------------------------------------------------------------------------
            |
            | The OAuth2 credentials are used to authenticate your application to
            | Google's API. Refer to the README for instructions on generating
            | these credentials. The following scopes will be required:
            |
            | - 'https://www.googleapis.com/auth/adwords'
            |
            */

            'OAUTH2' => [
                'clientId' => env('GOOGLE_ADS_CLIENT_ID'),
                'clientSecret' => env('GOOGLE_ADS_CLIENT_SECRET'),
                'refreshToken' => env('GOOGLE_ADS_REFRESH_TOKEN'),
            ],
        ],
    ],
];
