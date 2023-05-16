<?php

namespace App;

class Config
{
    public function __construct(
        public readonly string $host,
        public readonly int $port,
        public readonly array $database,
    ) {

    }
}
