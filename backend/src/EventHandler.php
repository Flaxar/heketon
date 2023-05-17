<?php

namespace App;

use App\Handlers\AuthHandler;
use App\Handlers\AddHandler;
use App\Handlers\WriteHandler;
use Workerman\Connection\ConnectionInterface;

class EventHandler
{
    private array $handlers = [
        'auth' => AuthHandler::class,
        'add' => AddHandler::class,
        'write' => WriteHandler::class,
    ];

    /** @property array<string, {0: User|Unit, 1: ConnectionInterface}> $connections*/
    private array $connections = [];

    public function __construct(
        private ORM $orm,
    ) {

    }

    public function handleIncomming(ConnectionInterface $connection, string $data): void
    {
        $handler = $this->getHandler($data);
        if ($handler === null) {
            $connection->send(json_encode(['status' => 0, 'error' => 'Invalid data']));
            return;
        }

        [$handler, $message] = $handler;
        try {
            $handler->handle($connection, $message, $this->connections);
        } catch (SkillIssue $e) {
            $connection->send(json_encode(['status' => 0, 'error' => $e->getMessage()]));
        }
    }

    public function handleConnection(ConnectionInterface $connection): void
    {
        // fido time
        $token = sha1(random_bytes(1024));
        $this->connections[$token] = [null, $connection];
        $connection->token = $token;
    }

    public function getHandler(string $data): ?array
    {
        $message = json_decode($data, true);
        if (!$message) {
            return null;
        }
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

        if (!isset($connection->token)) {
            $state = false;
        }

        if (!isset($this->connections[$connection->token][0])) {
            $state = false;
        }

        return $state;
    }
}
