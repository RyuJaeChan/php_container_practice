<?php

namespace wor\util;

/**
 * Class JsonBuilder
 *
 * @package wor\common
 */
trait JsonBuilder
{
    public static function builder()
    {
        return new ResponseJson;
    }
}
