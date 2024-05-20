<?php

namespace App\Tests\Services;

use App\Tests\AppTestCase;
use App\Services\CreditCards\BinlistNetLookup;

class BinlistLookupTest extends AppTestCase
{
    public function testInstance(): void
    {
        if ( isset($this->apiCredentials['binlist.net']) ){
            
            $obj = new BinlistNetLookup(
                $this->apiCredentials['binlist.net']['ApiUrl']
            );
            
            $this->assertInstanceOf(BinlistNetLookup::class,$obj);
            $this->assertNotEmpty($obj->lookup(45717360));
        }
    }
}