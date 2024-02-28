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

https://groups.google.com/g/adwords-api/c/B0VVHqNOLYs - Google Ads only has a single valid scope

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

### Google Ads Query Language
```php
use LukeTowers\GoogleAds\GoogleAds;

$googleAds = new GoogleAds();
$googleAds->query('SELECT campaign.id, campaign.name FROM campaign');
```


## Related Resources:

- [Google Ads API PHP Client Library](https://github.com/googleads/google-ads-php) & [Documentation](https://developers.google.com/google-ads/api/docs/client-libs/php)
- [Google Ads Query Language](https://developers.google.com/google-ads/api/docs/query/overview)
- [Google Ads API PHP Client Library Examples](https://github.com/googleads/google-ads-php/tree/main/examples)
