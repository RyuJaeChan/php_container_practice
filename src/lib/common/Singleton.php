<?php

namespace wor\lib\common;

trait Singleton
{
    private static $singleton = null;

    private function __construct()
    {
        $this->__instance();
    }

    public static function getInstance()
    {
        if (self::$singleton == null) {
            self::$singleton = new self();
        }
        return self::$singleton;
    }
}
