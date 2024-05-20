<?php

namespace App\Tests\Services;

use App\Tests\AppTestCase;
use App\Services\Currencies\ExchangeRatesApiIo;

class ExchangeRatesTest extends AppTestCase
{
    public function testInstance(): void
    {
        if ( isset($this->apiCredentials['exchangeratesapi.io']) ){
            
            $obj = new ExchangeRatesApiIo(
                $this->apiCredentials['exchangeratesapi.io']['ApiUrl'],
                $this->apiCredentials['exchangeratesapi.io']['ApiKey']
            );
            
            $this->assertInstanceOf(ExchangeRatesApiIo::class,$obj);
            $this->assertNotNull($obj->getCurrentRates('USD'));
            $this->assertNotNull($obj->getCachedRates('USD'));
        }
    }
}
