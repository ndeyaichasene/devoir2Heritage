<?php

namespace App\config;

use Dotenv\Dotenv;

class Bootstrap
{
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
    }
}