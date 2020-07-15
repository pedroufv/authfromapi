<?php

namespace App\Facades;

use App\Services\FromApiService;
use Illuminate\Support\Facades\Facade;

/**
 * Class FromApi
 * @package App\Facades
 *
 * @method static FromApiService getUser(int $id)
 */
class FromApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return FromApiService::class;
    }
}
