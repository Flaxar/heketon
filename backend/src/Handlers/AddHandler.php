<?php

namespace App\Handlers;

use App\Message;
use Workerman\Connection\ConnectionInterface;
use App\SkillIssue;

class AddHandler implements Handler
{
    public const Entities = [
        'user' => \App\Entities\User::class,
        'unit' => \App\Entities\Unit::class,
        'role' => \App\Entities\UnitRole::class,
        'light' => \App\Entities\Light::class,
        'temperature' => \App\Entities\Temperature::class,
        'window' => \App\Entities\Window::class,
    ];

    public function __construct(
        private \App\ORM $orm,
    ) {

    }

    public function handle(ConnectionInterface $connection, Message $message, array &$connections): void
    {
        $token = $connection->token;

        $user = $connections[$token][0];
        if (!($user instanceof \App\Entities\User)) {
            throw new SkillIssue('User is probably unit, how can possibly unit which is literaly just python firmware in some funny quartz block add entity');
        }

        if (!$user->admin) {
            throw new SkillIssue('You are not admin, what did you think?');
        }

        $entity = self::Entities[$message->get('entity')]
                  ?? throw new SkillIssue('Invalid entity')
                  ;

        try {
            $object = new $entity(...$message->get('data'));
        } catch (\Throwable $e) {
            throw new SkillIssue('Invalid data');
        }

        // Notes of pure pain
        // by Majkel (2021-05-17 3:57)
        // ok so I just wanted to say that its in hajzl
        // like normalne v hajzlu
        // proste nevim, neumim moc s databazema jak se ukazuje a je to na hovno, protoze to proste neuklada
        // nevim jak to udelat a uz to nezvladam
        // pokud toto dokoncim tak nevim
        
        $this->orm->getEntityManager()->persist($object)->run();
        $connection->send(json_encode(['status' => 1]));
    }
}
