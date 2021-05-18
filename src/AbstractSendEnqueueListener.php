<?php

declare(strict_types=1);

namespace Inisiatif\Package\Enqueue;

use Enqueue\Client\Message;
use Enqueue\SimpleClient\SimpleClient;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Inisiatif\Package\Enqueue\Concerns\EnqueueAwareInterface;

abstract class AbstractSendEnqueueListener implements ShouldQueue
{
    use InteractsWithQueue;

    public $afterCommit = true;

    protected SimpleClient $client;

    public function __construct(SimpleClient $client)
    {
        $this->client = $client;
    }

    public function handle(EnqueueAwareInterface $event): void
    {
        $data = $event->getMessageData();

        $message = new Message();
        $message->setMessageId($data->id);
        $message->setPriority($data->priority);

        $message->setProperties($data->properties);
        $message->setHeaders($data->headers);

        $message->setBody($data->body());

        $this->client->sendEvent($event->topicName(), $message);
    }
}
