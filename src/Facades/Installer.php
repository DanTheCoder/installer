<?php

namespace DanTheCoder\Installer\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DanTheCoder\Installer\Installer
 */
class Installer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \DanTheCoder\Installer\Installer::class;
    }
}
