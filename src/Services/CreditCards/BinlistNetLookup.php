<?php

namespace App\Services\CreditCards;

class BinlistNetLookup extends BinLookupFactory
{
    protected string $apiUrl;

    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;

        parent::__construct();
    }

    public function lookup(int $bin): string
    {
        $this->httpRequest->setHeaders(['Accept-Version: 3']);
        list($response,$httpCode) = $this->httpRequest->sendRequest($this->apiUrl . '/' . $bin);

        if ( $httpCode == 200 ){
            $lookup = @json_decode($response,true);
        }

        return isset($lookup['country']['alpha2']) ?? '';
    }
}