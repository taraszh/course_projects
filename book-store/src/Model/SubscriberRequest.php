<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;

class SubscriberRequest
{
    #[Email]
    #[NotBlank]
    private string $email;

    #[IsTrue]
    private bool $agree;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function isAgree(): bool
    {
        return $this->agree;
    }

    public function setAgree(bool $agree): void
    {
        $this->agree = $agree;
    }
}
