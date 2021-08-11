<?php

namespace App\Core\Logger;

abstract class FileBasedChannel extends Channel
{
    protected string $logFileName;

    public function __construct(string $channelName, string $logFileName)
    {
        $this->logFileName = $logFileName;
        parent::__construct($channelName);
    }
}