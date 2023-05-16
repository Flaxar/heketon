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
        $host = sprintf('ws://%s:%d', $this->config->host, $this->config->port);
        $worker = new Worker($host);
    
        $worker->runAll();
    }
}
