<?php

namespace App;

use App\Handlers\AuthHandler;
use Workerman\Connection\ConnectionInterface;

class EventHandler
{
    private array $handlers = [
        'auth' => AuthHandler::class,
    ];


    private array $connections = [];

    public function __construct(
        private ORM $orm,
    ) {

    }

    public function handleIncomming(ConnectionInterface $connection, string $data): void
    {
        $handler = $this->getHandler($connection, $data);
        if ($handler === null) {
            $connection->send(json_encode(['status' => 0, 'error' => 'Invalid type']));
            return;
        }

        [$handler, $message] = $handler;
        try {
            $handler->handle($connection, $message, $this->connections);
        } catch (\Throwable $e) {
            $connection->send(json_encode(['status' => 0, 'error' => $e->getMessage()]));
        }
    }

    public function handleConnection(ConnectionInterface $connection): void
    {
        // fido time
        $token = random_bytes(128);
        $this->connections[$token] = null;
    }

    public function getHandler(string $data): ?array
    {
        $message = json_decode($data, true);
        $type = $message['type'];
        if (!isset($this->handlers[$type])) {
            return null;
        }

        if (is_string($this->handlers[$type])) {
            $this->handlers[$type] = new $this->handlers[$type]($this->orm);
        }

        return [$this->handlers[$type], new Message($message)];
    }

    private function verify(array $message): bool 
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
