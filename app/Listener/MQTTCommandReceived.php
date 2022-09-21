<?php

declare(strict_types=1);

namespace App\Listener;

use App\IOT\Command;
use App\Event\MQTTReceived;
use Hyperf\Event\Annotation\Listener;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class MQTTCommandReceived implements ListenerInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    public function listen(): array
    {
        return [
            MQTTReceived::class
        ];
    }

    public function process(object $event): void
    {
        if($event instanceof MQTTReceived) {
            var_dump(Command::exec($event->message));
        }
    }
}
