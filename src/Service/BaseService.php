<?php

namespace Twim32\AvitoApi\Service;

use Twim32\AvitoApi\Client;

abstract class BaseService
{
    const DATETIME_FORMAT = 'Y-m-d H:i:s';
    
    const GLUE = '|';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function stringify(array $array): string
    {
        return implode(self::GLUE, $array);
    }
}