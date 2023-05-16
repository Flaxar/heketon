<?php

namespace App;

use Cycle\ORM\ORM;
use Illuminate\Container\Container;
use Workerman\Worker;

class App
{
    private Container $container;

    public function __construct(
        public Config $config,
    ) {
        $this->container = new Container();
        $this->container->bind(App::class, fn() => $this);
        $this->container->bind(Config::class, fn() => $this->config);
        $this->container->singleton(ORM::class);
        $this->container->singleton(EventHandler::class);
    }

    public function boot(): void
    {
        $host = sprintf('websocket://%s:%d', $this->config->host, $this->config->port);
        $worker = new Worker($host);

        $worker->onConnect = $this->container->make(EventHandler::class)->handleConnection(...);

        $worker->onMessage = $this->container->make(EventHandler::class)->handleIncomming(...); 
    
        Worker::runAll();
    }
}
