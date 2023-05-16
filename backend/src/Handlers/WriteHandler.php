<?php

namespace App\Handlers;

use App\Entities\Unit;
use App\Entities\User;
use App\Message;
use App\ORM;
use App\SkillIssue;
use App\Entities\Temperature;
use App\Entities\Light;
use App\Entities\Window;
use Throwable;
use Workerman\Connection\ConnectionInterface;

class WriteHandler extends Handler
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
            $what = $message->get('measured');
            $data = $message->get('data');
            try {
                $unit->set(ucfirst($what))(...$data);
            } catch (Throwable $e) {
                throw new SkillIssue('bad data idk');
            }

            return;
        }

        $measured = $message->get('measured');
        $unit = $message->get('unit');

        $entity = self::Measured[$measured] ?? throw new SkillIssue('Value is not measured');
        $entity = $this->orm->getORM()->getRepository($entity)->findOneBy(['unit' => $unit] );
    }
}
