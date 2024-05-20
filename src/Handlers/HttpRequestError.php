<?php

namespace App\Handlers;

class HttpRequestError extends \Exception
{
    public function __construct(int $errno, string $message = "", int $code = 0, \Throwable $previous = null)
    {
        $message = sprintf("curl request error %d: %s", $errno, $message);
        file_put_contents( sys_get_temp_dir() . '/' . strtotime('now') . '.log',json_encode([
            'datetime' => date('Y-m-d H:i:s'), 'message' => $message
        ]));

        parent::__construct($message, $code, $previous);
    }
}
