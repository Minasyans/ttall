<?php

namespace Minasyans\Ttall\Facades;

use Illuminate\Support\Facades\Facade;

class Ttall extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'ttall';
    }
}
