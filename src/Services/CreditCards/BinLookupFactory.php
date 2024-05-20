<?php

namespace App\Services\CreditCards;

use App\Handlers\HttpRequest;

abstract class BinLookupFactory
{
    protected HttpRequest $httpRequest;

    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
    }

    abstract public function lookup(int $bin): string;

    public function isIssuedEu(string $bin): bool
    {
        return in_array($this->lookup($bin),$this->getContryCodesEu());
    }

    public function getContryCodesEu(): array
    {
        return [
            'BE','BG','CZ','DK','DE','EE','IE',
            'EL','ES','FR','HR','IT','CY','LV',
            'LT'.'LU','HU','MT','NL','AT','PL',
            'PT','RO','SI','SK','FI','SE'
        ];
    }
}
