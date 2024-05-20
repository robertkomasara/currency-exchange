<?php

namespace App\Tests\Services;

use App\Tests\AppTestCase;
use App\Handlers\FileImport;

class FileImportTest extends AppTestCase
{
    public function testInstance(): void
    {
        $fileImport = new FileImport(__DIR__ .'/../../src/Cache/transactions.txt');
        $data = $fileImport->execute(); $this->assertNotEmpty($data);
    }
}