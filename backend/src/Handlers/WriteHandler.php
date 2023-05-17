<?php

namespace App\Handlers;

use App\Entities\Unit;
use App\Message;
use App\ORM;
use App\Permission;
use App\SkillIssue;
use App\Entities\Temperature;
use App\Entities\Light;
use App\Entities\Window;
use Throwable;
use Workerman\Connection\ConnectionInterface;

class WriteHandler implements Handler
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
        $user = $connections[$connection->token][0];

        if ($user instanceof Unit) {
            $what = $message->get('measured');
            $data = $message->get('data');
            try {
                $unit->{'set'.(ucfirst($what))}(...$data);
            } catch (Throwable $e) {
                throw new SkillIssue('bad data idk');
            }

            return;
        }

        $unit = $message->get('unit');

        if (!$user->can($unit, Permission::Write)) {
            throw new SkillIssue('You can\'t write to this unit');
        }

        $measured = $message->get('measured');
        $data = $message->get('data');
        foreach ($connections as $token => [$model, $_]) {
            if ($model instanceof Unit && $model->id === $unit) {
                $model->{'set'.(ucfirst($what))}(...$data);
                $connections[$token][1]->send(json_encode($message->data));
                return;
            }
        }
    }
}
