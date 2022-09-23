<?php

declare(strict_types=1);

namespace App\Process;

use App\Event\MQTTReceived;
use Xtwoend\HyperfMqttClient\MQTT;
use Hyperf\Process\AbstractProcess;
use Hyperf\Process\Annotation\Process;

#[Process(name: 'MQTTListener')]
class MQTTListener extends AbstractProcess
{
    public function handle(): void
    {
        $event = $this->event;
        $device = config('device');
        $topic = "sleepybox/{$device}";
        if($device) {
            $mqtt = MQTT::instance();
            $mqtt->subscribe($topic, function($topic, $message) use ($event) {
                $event->dispatch(new MQTTReceived($topic, $message));
            });
            $mqtt->loop(true);
        }
    }
}
