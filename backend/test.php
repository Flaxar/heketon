<?php

require __DIR__.'/vendor/autoload.php';

$client = new WebSocket\Client("ws://localhost:8000");
$client->send(json_encode(['type' => 'auth', 'as' => 'user', 'name' => 'majkel', 'password' => 'parek']));
echo $client->receive();
$client->send(json_encode([
    'type' => 'add',
    'entity' => 'unit',
    'data' => [
        'name' => 'curakov',
        'password' => 'parek',
        'people' => 3
    ]
]));
echo $client->receive();
$client->close();
$client = new WebSocket\Client("ws://localhost:8000");
$client->send(json_encode(['type' => 'auth', 'as' => 'unit', 'id' => 1, 'password' => 'parek']));
echo $client->receive();
$client->send(json_encode([
    'type' => 'write',
    'unit' => 1,
    'measured' => 'temperature',
    'data' => [
        'value' => 69,
    ] 
]));
echo $client->receive();
$client->close();
