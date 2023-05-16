<?php

include __DIR__ . '/vendor/autoload.php';

use App\App;
use App\Env;

Env::init(__DIR__);

$app = new App(require __DIR__ . '/config.php');

$app->boot();
