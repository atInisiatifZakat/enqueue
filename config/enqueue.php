<?php

declare(strict_types=1);

return [
    'transport' => [
        'dsn' => env('ENQUEUE_DSN', 'null://')
    ],
    'extensions' => [
        'signal_extension' => true,
        'reply_extension' => false
    ],
    'client' => [
        'default' => [
            'router_topic' => 'default',
            'router_queue' => 'default',
            'default_queue' => 'default',
        ]
    ],
];
