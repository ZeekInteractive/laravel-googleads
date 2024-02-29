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

Modify the `config/googleads.php` file to include your Google Ads credentials and other settings. You will need the following:

- `developerToken` - Your Google Ads developer token, see https://developers.google.com/google-ads/api/docs/get-started/dev-token & https://developers.google.com/google-ads/api/docs/best-practices/test-accounts
- `clientId` & `clientSecret` - Your Google API Console OAuth2 Client ID & Secret, see https://developers.google.com/google-ads/api/docs/get-started/oauth-cloud-project
- `refreshToken` - The refresh token for the account you to access, see the usage example below for how you can use Socialite to obtain this.
- `clientCustomerId` - The customer ID of the account you want to access, see https://developers.google.com/google-ads/api/docs/best-practices/test-accounts

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

>**NOTE:** This is not implemented yet.

```php
$googleAds = App::make('google-ads');
$googleAds->query('SELECT campaign.id, campaign.name FROM campaign');
```

### Use Socialite to obtain a refresh token

[Laravel Socialite](https://laravel.com/docs/10.x/socialite) makes it easy to work with OAuth providers. Here's an example of how you can use it to obtain a refresh token for a Google Ads account:

>**NOTE:** Ensure that your application hostname is added to the Authorized JavaScript origins in the Google API Console and that the redirect URI is added to the Authorized redirect URIs. (i.e. `https://example.com` and `https://example.com/oauth-redirect`)

`routes/web.php`:

```php
Route::get('google-auth', [GoogleController::class, 'redirectToGoogle'])
    ->name('google-auth.init');

Route::get('oauth-redirect', [GoogleController::class, 'handleGoogleCallback']);
```

`App\Http\Controllers\GoogleController.php`:

>**NOTE:** `Record` is a model where you will be storing your refresh token.

```php
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function redirectToGoogle(Request $request, Record $record)
    {
        $driver = Socialite::driver('google');

        $driver->scopes($this->getScopes())
            ->with([
                'access_type' => 'offline',
                'prompt'      => 'consent select_account',
            ]);

        Session::put('record_id', $record->id);
        Session::forget('google-connection-error');

        return $driver->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $record = Record::find(Session::get('record_id'));

        try {
            $driver = Socialite::driver('google');
            $oauth  = $driver->user();

            // Update record info with oauth provider's info
            $campaign->update([
                'google_id'            => $oauth->id,
                'google_refresh_token' => $oauth->refreshToken,
            ]);
        } catch (ClientException $e) {
        }

        Session::forget('google-connection-error');
        return redirect(route('records.edit', $record))->with('status', 'Select your Google Ads customer account.');
    }

    private function getScopes(): array
    {
        return [
            'https://www.googleapis.com/auth/adwords',
        ];
    }
}
```

## Related Resources:

- [Google Ads API PHP Client Library](https://github.com/googleads/google-ads-php) & [Documentation](https://developers.google.com/google-ads/api/docs/client-libs/php)
- [Google Ads Query Language](https://developers.google.com/google-ads/api/docs/query/overview)
- [Google Ads API PHP Client Library Examples](https://github.com/googleads/google-ads-php/tree/main/examples)
