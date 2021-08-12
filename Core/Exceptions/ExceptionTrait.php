<?php

namespace App\Core\Exceptions;

trait ExceptionTrait
{
    protected int $responseCode = 500;

    public function getResponseCode(): int
    {
        return $this->responseCode;
    }
}