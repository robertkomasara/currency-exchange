<?php

namespace App\Handlers;

class HttpRequest
{
    protected $curlHandle;

    protected array $curlOptions = [
        CURLOPT_HEADER => 0, CURLOPT_RETURNTRANSFER => 1, 
        CURLOPT_CONNECTTIMEOUT => 0, CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => 1, CURLOPT_MAXREDIRS => 10,
        CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0,
    ];

    public function __construct()
    {
        $this->curlHandle = curl_init();
    }

    public function setMethod(string $method): void
    {
        curl_setopt($this->curlHandle, CURLOPT_CUSTOMREQUEST, $method);
    }

    public function setHeaders(array $headers = []): void
    {
        curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, $headers);
    }

    public function sendRequest(string $url, string $data = ''): array
    {
        $this->curlOptions[CURLOPT_URL] = $url;

        if( strlen($data) ){
            $this->curlOptions[CURLOPT_POST] = true;
            $this->curlOptions[CURLOPT_POSTFIELDS] = $data;
        }

        curl_setopt_array($this->curlHandle, $this->curlOptions);
        $response = curl_exec($this->curlHandle);
        
        if( $errno = curl_errno($this->curlHandle) ){
            throw new HttpRequestError($errno, curl_strerror($errno));
        }        
        
        $httpCode = curl_getinfo($this->curlHandle, CURLINFO_HTTP_CODE);
        
        return [$response,$httpCode];
    }
}