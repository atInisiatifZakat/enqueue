<?php

declare(strict_types=1);

return [
    'client' => [
        'transport' => [
            'dsn' => env('ENQUEUE_DSN', 'null://')
        ],
        'client' => [
            'router_topic' => 'default',
            'router_queue' => 'default',
            'default_queue' => 'default',
      ],
    ]
];