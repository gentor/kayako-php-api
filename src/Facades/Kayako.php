<?php

namespace Gentor\Kayako\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Gentor\Kayako\KayakoService
 */
class Kayako extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kayako';
    }
}
