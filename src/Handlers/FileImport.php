<?php

namespace App\Handlers;

class FileImport
{
    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function execute(): array
    {
        $data = [];

        $fp = @fopen($this->filePath, "r");
        while (($line = fgets($fp)) !== false) {
            $data[] = json_decode($line,true);
        }
        fclose($fp);

       return $data;
    }
}