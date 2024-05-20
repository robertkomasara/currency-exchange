<?php

namespace App\Services\Currencies;

class ExchangeRatesApiIo extends ExchangeRatesFactory
{
    protected string $apiUrl;
    protected string $apiKey;

    public function __construct(string $apiUrl, string $apiKey)
    {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;

        parent::__construct();
    }

    public function getCurrentRates(string $currency): ?float
    {
        $this->httpRequest->setHeaders([sprintf('apikey: %s',$this->apiKey)]);
        list($response,$httpCode) = $this->httpRequest->sendRequest($this->apiUrl);

        if ( $httpCode == 200 ){
            $rates = @json_decode($response,true);
        }

        return isset($rates['rates'][$currency]) ?? null;
    }
}
