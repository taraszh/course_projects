<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

class SubscriberExistsException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('subscriber already exists', Response::HTTP_CONFLICT);
    }
}
