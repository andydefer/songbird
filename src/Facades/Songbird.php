<?php

namespace AndyKani\Songbird\Facades;

use Illuminate\Support\Facades\Facade;

class Songbird extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'songbird';
    }
}
