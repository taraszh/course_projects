<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

class BookNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('book not found', Response::HTTP_BAD_REQUEST);
    }
}
