<?php

require __DIR__.'/vendor/autoload.php';

$client = new WebSocket\Client("ws://localhost:8000");
$client->send(json_encode(['type' => 'auth', 'as' => 'user', 'name' => 'majkel', 'password' => 'penis']));
echo $client->receive();
$client->close();
