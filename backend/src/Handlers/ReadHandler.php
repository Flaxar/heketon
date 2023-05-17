<?php

namespace App\Handlers;

use App\Entities\Unit;
use App\Message;
use App\ORM;
use App\SkillIssue;
use App\Entities\Temperature;
use App\Entities\Light;
use App\Entities\Window;
use Workerman\Connection\ConnectionInterface;

class ReadHandler implements Handler
{
    public const Measured = [
        'temperature' => Temperature::class,
        'light' => Light::class,
        'window' => Window::class,
    ];

    public function __construct(
        private ORM $orm
    ) {

    }

    public function handle(ConnectionInterface $connection, Message $message, array &$connections): void
    {
        $user = $connections[$connection->token];
        if ($user instanceof Unit) {
            throw new SkillIssue('I\'m sorry, but you are unit, literaly just some random software in some quartz block, thus you cant read, I apologize');            
        }

        $measured = $message->get('measured');
        $unit = $message->get('unit');

        $entity = self::Measured[$measured] ?? throw new SkillIssue('Value is not measured');
        $entity = $this->orm->getORM()->getRepository($entity)->findOneBy(['unit' => $unit] );
    }
}
