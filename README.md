# laravel-googleads
Simplifies using the google-ads-php client library and Google Ads Query Language in Laravel

## Installation
```bash
composer require luketowers/laravel-googleads
```

## Configuration
```bash
php artisan vendor:publish --provider="LukeTowers\GoogleAds\GoogleAdsServiceProvider"
```

Modify the `config/googleads.php` file to include your Google Ads credentials and other settings.

## Notes

### Google Ads does not have a read-only scope

See https://groups.google.com/g/adwords-api/c/B0VVHqNOLYs, the only oauth scope available is `https://www.googleapis.com/auth/adwords` which is read-write. In order to protect against accidental writes, you should use a separate Google Ads account for read-only access.

## Usage

### Get the Google Ads client
```php
$googleAds = App::make('google-ads');
```

or

```php
use LukeTowers\GoogleAds\GoogleAds;

$googleAds = new GoogleAds([
    'developerToken' => env('GOOGLE_ADS_DEVELOPER_TOKEN'),
    'clientCustomerId' => env('GOOGLE_ADS_CLIENT_CUSTOMER_ID'),
    'loginCustomerId' => env('GOOGLE_ADS_LOGIN_CUSTOMER_ID'),
    'clientId' => env('GOOGLE_ADS_CLIENT_ID'),
    'clientSecret' => env('GOOGLE_ADS_CLIENT_SECRET'),
    'refreshToken' => env('GOOGLE_ADS_REFRESH_TOKEN'),
]);
```

### List all customers that the authenticated user has access to

```php
$ads = new GoogleAds([
    'clientId' => config('services.google.client_id'),
    'clientSecret' => config('services.google.client_secret'),
    'developerToken' => config('services.google.ads_dev_token'),
    'refreshToken' => $user->google_refresh_token,
]);

$ads->listCustomers(); // ['customerId' => 'Descriptive Name']
```

### Google Ads Query Language

>**NOTE:** Not implemented yet.

```php
$googleAds = App::make('google-ads');
$googleAds->query('SELECT campaign.id, campaign.name FROM campaign');
```

## Related Resources:

- [Google Ads API PHP Client Library](https://github.com/googleads/google-ads-php) & [Documentation](https://developers.google.com/google-ads/api/docs/client-libs/php)
- [Google Ads Query Language](https://developers.google.com/google-ads/api/docs/query/overview)
- [Google Ads API PHP Client Library Examples](https://github.com/googleads/google-ads-php/tree/main/examples)
