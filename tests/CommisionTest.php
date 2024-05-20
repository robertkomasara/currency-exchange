<?php

namespace App\Tests;

use App\Handlers\FileImport;
use App\Services\CreditCards\BinlistNetLookup;
use App\Services\Currencies\ExchangeRatesApiIo;

class CommisionTest extends AppTestCase
{
    public function testCalculation(): void
    {
        $bin = new BinlistNetLookup(
            $this->apiCredentials['binlist.net']['ApiUrl']
        );

        $rates = new ExchangeRatesApiIo(
            $this->apiCredentials['exchangeratesapi.io']['ApiUrl'],
            $this->apiCredentials['exchangeratesapi.io']['ApiKey']
        );

        $fileImport = new FileImport(__DIR__ .'/../src/Cache/transactions.txt');
        $transactions = $fileImport->execute();

        foreach( $transactions as $transaction ){
         
            $isIssuedEu = $bin->isIssuedEu(intval($transaction['bin']));
            $value = $rates->calculateCommision($transaction['currency'],$transaction['amount'],$isIssuedEu);
            $this->assertNotEmpty($value); echo PHP_EOL; var_dump($value);

            sleep(3);
        }
    }
}