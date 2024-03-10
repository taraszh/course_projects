<?php

namespace App\Model;

class ErrorResponse
{
    public function __construct(
        private string $message,
        private array|null $details = null
    ) {
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getDetails(): ?array
    {
        return $this->details;
    }
}
