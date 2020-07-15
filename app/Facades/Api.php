<?php

namespace App\Facades;

use App\Services\ApiService;
use Illuminate\Support\Facades\Facade;

class Api extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ApiService::class;
    }
}
