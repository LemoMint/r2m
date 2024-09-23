<?php

namespace App\Tests\Helper;

trait DIHelper
{
    public function getService(string $serviceName): mixed
    {
        if (static::getContainer()->has($serviceName)) {
            return static::getContainer()->get($serviceName);
        }

        return  null;
    }
}