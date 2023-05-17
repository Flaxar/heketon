<?php

require __DIR__.'/vendor/autoload.php';

$client = new WebSocket\Client("ws://localhost:8000");
echo $client->receive();
$client->close();
