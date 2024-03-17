<?php

namespace App\Model;

use OpenApi\Attributes\Property;

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

    #[Property(type:'object')]
    public function getDetails(): ?array
    {
        return $this->details;
    }
}
