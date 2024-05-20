<?php

namespace App\Tests\Services;

use App\Tests\AppTestCase;
use App\Handlers\HttpRequest;

class HttpRequestTest extends AppTestCase
{
    public function testInstance(): void
    {
        $httpRequest = new HttpRequest();
        $this->assertInstanceOf(HttpRequest::class,$httpRequest);
        list($response,$httpCode) = $httpRequest->sendRequest('https://apilayer.com/');
        $this->assertSame(200,$httpCode); $this->assertNotEmpty($response);
    }
}