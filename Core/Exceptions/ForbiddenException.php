<?php

namespace App\Core\Exceptions;

class ForbiddenException extends Exception
{
    protected int $responseCode = 403;
    protected $message = 'Forbidden Page';
}