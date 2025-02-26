<?php

declare(strict_types=1);

namespace Inisiatif\Package\Enqueue;

use Enqueue\Client\MessagePriority;

final class MessageData
{
    public string $id;

    public string $app;

    public array $data;

    public string $priority = MessagePriority::NORMAL;

    public array $properties = [];

    public array $headers = [];

    /**
     * @return array<string, mixed> $data
     */
    public function body(): array
    {
        return [
            'id' => $this->id,
            'app' => $this->app,
            'data' => $this->data,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'app' => $this->app,
            'data' => $this->data,
            'priority' => $this->priority,
            'properties' => $this->properties,
            'headers' => $this->headers,
        ];
    }

    /**
     * @param array<string, mixed> $data
     */
    public function fromArray(array $data): self 
    {
        $self = new self();
        
        if (!isset($data['id'], $data['app'], $data['data'])) {
            throw new \InvalidArgumentException('Invalid message data');
        }

        $self->id = $data['id'];
        $self->app = $data['app'];
        $self->data = $data['data'];
        $self->priority = $data['priority'] ?? MessagePriority::NORMAL;
        $self->properties = $data['properties'] ?? [];
        $self->headers = $data['headers'] ?? [];

        return $self;
    }
}
