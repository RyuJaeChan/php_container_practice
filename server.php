<?php

require_once "vendor/autoload.php";

define("__ROOT__", dirname(__FILE__));

use wor\lib\container\Container;
use wor\lib\app\SummerFramework;

$app = Container::getInstance()
    ->get(SummerFramework::class);

$app->run(
    $_SERVER["REQUEST_URI"],
    $_SERVER["REQUEST_METHOD"]
);
