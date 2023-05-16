<?php

namespace App\Handlers;

use Workerman\Connection\ConnectionInterface;

class AuthHandler implements Handler
{
    public function handle(ConnectionInterface $connection, array $message, array &$connections): void
    {

    }

    public function handleReadConnection(ConnectionInterface $connection, array $message, array &$connections): void
    {
         
    }
}
