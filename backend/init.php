<?php

include __DIR__ . '/vendor/autoload.php';

use App\App;

$app = new App(require __DIR__ . '/config.php');

$app->boot();
