<?php

require __DIR__.'/vendor/autoload.php';

$client = new WebSocket\Client("ws://localhost:8000");
$client->send(json_encode(['from' => 'hardware', 'data' => ['temp' => 37]]));
echo $client->receive();
$client->close();
