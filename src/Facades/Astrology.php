<?php

namespace ismailcaakir\Astrology\Facades;

use Illuminate\Support\Facades\Facade;

class Astrology extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'astrology';
    }
}
