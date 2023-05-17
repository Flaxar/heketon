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

    /** @property array<string, {0: ?User|?Unit, ConnectionInterface}> $connections*/
    private array $connections = [];

    public function __construct(
        private Config $config,
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
        if (!$this->verify($connection, $message->data)) {
            $connection->send(json_encode(['status' => 0, 'error' => 'Unverified']));
            return;
        }
        try {
            // a tak besnim jako drabec lesni masozravec vesmir
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

        return [new $this->handlers[$type](new ORM($this->config)), new Message($message)];
    }

    private function verify(ConnectionInterface $connection, array $message): bool 
    { 
        if ($this->connections[$connection->token][0] !== null) { 
            return true;
        }

        if ($message['type'] === 'auth') {
            return true;
        }

        return false;
    }
}
