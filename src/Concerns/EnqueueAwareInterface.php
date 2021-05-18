<?php

declare(strict_types=1);

namespace Inisiatif\Package\Enqueue\Concerns;

use Inisiatif\Package\Enqueue\MessageData;

interface EnqueueAwareInterface
{
    public function topicName(): string;

    public function getMessageData(): MessageData;
}
