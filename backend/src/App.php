<?php

namespace App;

use Workerman\Worker;

class App
{
    public function __construct(
        public Config $config
    ) {

    }

    public function boot(): void
    {
        $worker = new Worker(sprintf('http://%s:%d', $this->config->host, $this->config->port));
        $worker->onMessage = function ($connection, $data) {
            $connection->send('Hello World');
        };
        $worker->listen();
        $worker->run();
    }
}
