<?php

declare(strict_types=1);

namespace Inisiatif\Package\Enqueue;

use Enqueue\Client\MessagePriority;
use Inisiatif\Package\Common\Concerns\HasArrayHydrator;

final class MessageData
{
    use HasArrayHydrator;

    public string $id;

    public string $app;

    public array $data;

    public string $priority = MessagePriority::NORMAL;

    public array $properties = [];

    public array $headers = [];

    public function body(): array
    {
        return [
            'id' => $this->id,
            'app' => $this->app,
            'data' => $this->data,
        ];
    }
}
