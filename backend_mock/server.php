<?php

use Workerman\Worker;

require __DIR__ . '/vendor/autoload.php';

$worker = new Worker('websocket://localhost:8000');

$id = 0;

$worker->onConnect = function ($connection) use (&$id) {
    $connection->id = $id++;
};

$worker->onMessage = function ($connection, $data) {
    $message = json_decode($data, true);
    if ($message['from'] === 'hardware') {
        foreach ($connection->worker->connections as $clientConnection) {
            if ($clientConnection->id !== $connection->id) {
                $clientConnection->send($message['data']);
            }
        }
        return;
    }
};

Worker::runAll();
