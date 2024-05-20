<?php

namespace App\Services\Currencies;

use App\Handlers\HttpRequest;

abstract class ExchangeRatesFactory
{
    protected HttpRequest $httpRequest;

    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
    }

    abstract public function getCurrentRates(string $currency): ?float;

    public function getCachedRates(string $currency): float
    {
        $filePath = realpath(__DIR__ . '/../../Cache/currencies.json');
        $currencies = @json_decode(file_get_contents($filePath),true);

        return $currencies['rates'][$currency];
    }

    public function calculateCommision(string $currency, float $ammount, bool $isEu): float
    {
        $rate = $this->getCurrentRates($currency);
        $rate = isset($rate) ?? $this->getCachedRates($currency);

        $ammountFixed = $ammount;
        if ( $currency != 'EUR' || floatval($rate) ){
            $ammountFixed = $ammount / $rate;
        }
    
        return number_format($ammountFixed * ( $isEu ? 0.01 : 0.02 ), 2);
    }
}
