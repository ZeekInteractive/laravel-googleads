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
            | !!! WARNING !!!
            |
            | Each Google API Console project can be associated with the developer
            | token from only one manager account. Once you make a Google Ads API
            | request, the developer token is permanently paired to the Google API
            | Console project. If you don't use a new Google API Console project,
            | you'll get a DEVELOPER_TOKEN_PROHIBITED error when making a request.
            |
            | If integrating into an existing project, be extremely careful not to
            | mix a temporary developer token meant for testing with your production
            | OAuth Client ID & Secret or you will be forced to either permanently
            | use the test developer token or create a new Google API Console project.
            |
            | @see https://developers.google.com/google-ads/api/docs/common-errors#developer_token_prohibited
            | @see https://groups.google.com/g/adwords-api/c/YboB7F2RZyI
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
            | Google API Console Credentials
            |--------------------------------------------------------------------------
            |
            | The Google API Console credentials are used to authenticate your
            | application to Google's API. Both the Client ID and the Client
            | Secret are required and can be found in the API Console.
            |
            | @see https://developers.google.com/google-ads/api/docs/get-started/oauth-cloud-project
            |
            */

            'clientId' => env('GOOGLE_ADS_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_ADS_CLIENT_SECRET'),

            /*
            |--------------------------------------------------------------------------
            | OAuth2 Refresh Token
            |--------------------------------------------------------------------------
            |
            | The OAuth2 refresh token is used to authenticate your application to
            | Google's API on behalf of a user. Refer to the README for
            | instructions on obtaining a refresh token.
            |
            | The following scopes will be required when requesting the refresh token:
            |
            | - 'https://www.googleapis.com/auth/adwords'
            |
            */

            'refreshToken' => env('GOOGLE_ADS_REFRESH_TOKEN'),

        ],
    ],
];
