<?php

namespace App;

use Cycle\ORM\ORM;
use Illuminate\Contracts\Container\Container;
use Workerman\Worker;

class App
{
    private Container $container;

    public function __construct(
        public Config $config,
        public string $basePath
    ) {
        $this->container = new Container();
        $this->container->bind(App::class, fn() => $this);
        $this->container->singleton(ORM::class);
    }

    public function boot(): void
    {
        $host = sprintf('ws://%s:%d', $this->config->host, $this->config->port);
        $worker = new Worker($host);
    
        $worker->runAll();
    }
}
