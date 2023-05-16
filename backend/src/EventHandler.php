<?php

namespace App;

use App\Handlers\Handler;
use Workerman\Connection\ConnectionInterface;

class EventHandler
{
    private array $handlers = [
        'auth' => AuthHandler::class
    ];

    private array $connections = [];

    public function handleIncomming(ConnectionInterface $connection, string $data): void
    {
        $handler = $this->getHandler($connection, $data);
        if ($handler === null) {
            return;
        }

        [$handler, $message] = $handler;
        $handler->handle($connection, $message, $this->connections);
    }

    public function handleConnection(ConnectionInterface $connection): void
    {
        // fido time
        $token = random_bytes(128);
        $this->connections[$token] = null;
    }

    public function getHandler(ConnectionInterface $connection, string $data): ?array
    {
        $message = json_decode($data, true);
        $type = $message['type'];
        if (!isset($this->handlers[$type])) {
            return null;
        }

        if (is_string($this->handlers[$type])) {
            $this->handlers[$type] = new $this->handlers[$type]($connection, $message);
        }

        return [$this->handlers[$type], $message];
    }

    private function verify(array $message): true
    {
        $state = false;
        if ($message['type'] === 'auth') {
            $state = true;
        }

        if (!isset($message['token'])) {
            $state = false;
        }

        if (!isset($this->connections[$message['token']])) {
            $state = false;
        }

        if ($this->connections[$message['token']] === null) {
            $state = false;
        }

        return $state;
    }
}
