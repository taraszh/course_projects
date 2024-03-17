<?php

namespace App\Exception;

use RuntimeException;

class RequestBodyConvertException extends RuntimeException
{
    public function __construct(
        string $message = "error while unmarshalling request body",
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
