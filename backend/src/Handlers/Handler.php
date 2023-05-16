<?php

namespace App\Handlers;

use Workerman\Connection\ConnectionInterface;

interface Handler
{
    public function handle(ConnectionInterface $connection, array $message, array &$connections): void;
}
