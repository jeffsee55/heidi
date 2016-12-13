<?php

namespace Heidi;

class Heidi
{
    protected static $singleInstance = null;

    public static function getInstance()
    {
        if(null === self::$singleInstance)
        {
            self::$singleInstance = new self();
        }

        return self::$singleInstance;
    }
}
