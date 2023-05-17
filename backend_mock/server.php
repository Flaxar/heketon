<?php

use Workerman\Worker;

require __DIR__ . '/vendor/autoload.php';

$worker = new Worker('websocket://0.0.0.0:8000');

$id = 0;

$worker->onConnect = function ($connection) use (&$id) {
    $connection->id = $id++;
};

$worker->onMessage = function ($connection, $data) {
    echo $data.PHP_EOL;
    foreach ($connection->worker->connections as $clientConnection) {
        if ($clientConnection->id !== $connection->id) {
            $clientConnection->send($data);
        }
    }
};

Worker::runAll();
