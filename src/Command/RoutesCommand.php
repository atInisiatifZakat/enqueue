<?php

namespace Inisiatif\Package\Enqueue\Command;

use Enqueue\SimpleClient\SimpleClient;
use Enqueue\Symfony\Client\SimpleRoutesCommand;

abstract class RoutesCommand extends SimpleRoutesCommand
{
    public function __construct(SimpleClient $client)
    {
        parent::__construct($client->getDriver());
    }
}
