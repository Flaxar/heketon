<?php

namespace App\Handlers;

use App\Message;
use Workerman\Connection\ConnectionInterface;

interface Handler
{
    public function handle(ConnectionInterface $connection, Message $message, array &$connections): void;
}
