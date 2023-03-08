<?php

declare(strict_types=1);

namespace Inisiatif\Package\Enqueue;

use Illuminate\Support\Arr;
use Psr\Log\LoggerInterface;
use Enqueue\SimpleClient\SimpleClient;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;

final class EnqueueServiceProvider extends ServiceProvider
{
    /**
     * @psalm-suppress UndefinedInterfaceMethod
     */
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

            $configs = \array_merge(Arr::only($config->get('enqueue'), ['transport', 'extensions']), [
                'client' => $config->get('enqueue.client.default'),
            ]);

            return new SimpleClient($configs, $logger);
        });
    }
}
