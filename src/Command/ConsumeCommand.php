<?php

declare(strict_types=1);

namespace Inisiatif\Package\Enqueue\Command;

use Enqueue\SimpleClient\SimpleClient;
use Enqueue\Symfony\Client\SimpleConsumeCommand;

abstract class ConsumeCommand extends SimpleConsumeCommand
{
    public function __construct(SimpleClient $client)
    {
        parent::__construct(
            $client->getQueueConsumer(),
            $client->getDriver(),
            $client->getDelegateProcessor()
        );

        $this->setAliases([]);
    }
}
