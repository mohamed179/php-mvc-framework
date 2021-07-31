<?php

namespace App\Core\Exceptions;

class ForbiddenException extends \Exception
{
    protected $code = 403;
    protected $message = 'Forbidden Page';
}