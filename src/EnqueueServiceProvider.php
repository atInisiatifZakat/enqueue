<?php

declare(strict_types=1);

namespace Inisiatif\Package\Enqueue;

use Psr\Log\LoggerInterface;
use Enqueue\SimpleClient\SimpleClient;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Enqueue\LaravelQueue\Command\RoutesCommand;
use Enqueue\LaravelQueue\Command\ConsumeCommand;
use Enqueue\LaravelQueue\Command\ProduceCommand;
use Enqueue\LaravelQueue\Command\SetupBrokerCommand;

final class EnqueueServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/enqueue.php', 'enqueue');

        if (class_exists('Enqueue\SimpleClient\SimpleClient') === false) {
            throw new \LogicException('The enqueue/simple-client package is not installed');
        }

        $this->app->singleton(SimpleClient::class, function () {
            /** @var Repository $config */
            $config = $this->app['config'];

            /** @var LoggerInterface $logger */
            $logger = $this->app->make('log');

            return new SimpleClient($config->get('enqueue.client'), $logger);
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupBrokerCommand::class,
                ProduceCommand::class,
                RoutesCommand::class,
                ConsumeCommand::class,
            ]);
        }
    }
}
