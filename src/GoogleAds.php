<?php

namespace LukeTowers\LaravelGoogleAds;

use Google\Ads\GoogleAds\Lib\Configuration;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
use Google\Ads\GoogleAds\Lib\V16\GoogleAdsClient;
use Google\Ads\GoogleAds\Lib\V16\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\V16\Services\ListAccessibleCustomersRequest;
use Google\Ads\GoogleAds\V16\Services\SearchGoogleAdsRequest;
use Google\ApiCore\ApiException;
use Google\Auth\FetchAuthTokenInterface;

class GoogleAds
{
    protected Configuration $config;
    protected GoogleAdsClient $client;
    protected FetchAuthTokenInterface $oAuth2Credential;

    public function __construct(array $config = [])
    {
        // @TODO: Apply validation to the config array passed in

        // Build the configuration
        $this->config = new Configuration($config);

        // Build the OAuth2 credentials
        $this->oAuth2Credential = (new OAuth2TokenBuilder())
            ->from($this->config)
            ->build();

        // Build the client
        $this->client = (new GoogleAdsClientBuilder())
            ->from($this->config)
            ->withOAuth2Credential($this->oAuth2Credential)
            ->build();
    }

    /**
     * Get the underlying GoogleAdsClient instance
     */
    public function getClient(): GoogleAdsClient
    {
        return $this->client;
    }

    /**
     * List the Customer accounts available to the current instance
     *
     * This will be affected by the OAuth2 credentials used to authenticate
     * and the developer token used to build the client
     */
    public function listCustomers(): array
    {
        $customers = [];

        $client = $this->getClient();

        $customerServiceClient = $client->getCustomerServiceClient();
        $response = $customerServiceClient->listAccessibleCustomers(new ListAccessibleCustomersRequest());
        $accessibleCustomers = $response->getResourceNames();

        foreach ($accessibleCustomers as $customerResourceName) {
            $customerId = str_replace('customers/', '', $customerResourceName);
            $query = "SELECT customer.descriptive_name FROM customer WHERE customer.id = $customerId";
            $request = SearchGoogleAdsRequest::build($customerId, $query);

            try {
                $response = $client->getGoogleAdsServiceClient()->search($request);
            } catch (ApiException $ex) {
                continue;
            }

            foreach ($response->iterateAllElements() as $googleAdsRow) {
                $customer = $googleAdsRow->getCustomer();
                $descriptiveName = $customer->getDescriptiveName();
                $customers[$customerId] = $descriptiveName;
            }
        }

        return $customers;
    }
}
