<?php

use App\Config;
use Cycle\Database\Config as CycleConfig;

return new Config(
    host: 'localhost',
    port: 8000,
    database: [
        'default' => 'default',
        'databases' => [
            'default' => ['connection' => 'sqlite'],
        ],
        'connections' => [
            'sqlite' => new CycleConfig\SQLiteDriverConfig(
                connection: new CycleConfig\SQLite\FileConnectionConfig(
                    database: getenv('DB_FILE'),
                ),
                queryCache: true,
            ),
        ],
    ]
);
