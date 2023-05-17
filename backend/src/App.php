<?php

namespace App;

use Workerman\Worker;

class App
{
    public function __construct(
        public Config $config,
    ) {
    }

    public function boot(): void
    {
        $host = sprintf('websocket://%s:%d', $this->config->host, $this->config->port);
        $worker = new Worker($host);

        $orm = new ORM($this->config);
        $eventHandler = new EventHandler($orm);
        $worker->onConnect = $eventHandler->handleConnection(...);

        $worker->onMessage = $eventHandler->handleIncomming(...); 

        Worker::runAll();
    }
}
