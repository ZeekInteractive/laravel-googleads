<?php

namespace LukeTowers\LaravelGoogleAds;

use Google\Ads\GoogleAds\Lib\Configuration;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
use Google\Ads\GoogleAds\Lib\V16\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\Lib\V16\GoogleAdsClient;
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
}
