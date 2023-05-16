<?php

namespace App\Handlers;

use App\Entities\Unit;
use App\Entities\User;
use App\Message;
use App\ORM;
use Exception;
use Workerman\Connection\ConnectionInterface;

class AuthHandler implements Handler
{
    public function __construct(
        private ORM $orm,
    ) {

    }

    public function handle(ConnectionInterface $connection, Message $message, array &$connections): void
    {
        $as = $message->get('as');
        (match($as) {
            'user' => $this->handleUserConnection(...),
            'unit' => $this->handleUnitConnection(...),
            default => throw new Exception('no tak ses asi kokot nebo jak to vidis'),
        })($connection, $message, $connections);
    }

    public function handleUserConnection(ConnectionInterface $connection, Message $message, array &$connections): void
    {
        $token = $message->get('token');
        if (!isset($connections[$token])) {
            throw new Exception('Invalid token');
        }

        $user = $this->orm->getORM()->getRepository(User::class)->findOne(['name' => $message->get('name')]);

        if ($user === null) {
            throw new Exception('Invalid name');
        }

        if (!password_verify($message->get('password'), $user->password)) {
            throw new Exception('Invalid password');
        }

        $connections[$token] = $user;
        $connection->send(json_encode(['status' => 1]));
    }

    public function handleUnitConnection(ConnectionInterface $connection, Message $message, array &$connections): void
    {
         $token = $message->get('token');
        if (!isset($connections[$token])) {
            throw new Exception('Invalid token');
        }

        $unit = $this->orm->getORM()->getRepository(Unit::class)->findByPK($message->get('id'));

        if ($unit === null) {
            throw new Exception('Invalid id');
        }

        if (!password_verify($message->get('password'), $unit->password)) {
            throw new Exception('Invalid password');
        }

        /*
            Lets have a quick break and do some theoretical informatics

            This is formal grammar for json:
            S -> s
            S -> i
            S -> a
            S -> d
            s -> "[a-zA-Z0-9]*" // etc, im lazy 
            i -> [0-9]+
            ai -> S,ai
            ai -> S
            a -> [ai]
            di -> s:S,di
            di -> s:S
            d -> {di}
         */

        $connections[$token] = $unit;
        $connection->send(json_encode(['status' => 1]));        
    }
}
