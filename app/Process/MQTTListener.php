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
        $topics = ["sleepybox/{$device}/door", "sleepybox/{$device}/lamp", "sleepybox/{$device}/mute"];
        
        $mqtt = MQTT::instance();
        foreach($topics as $topic) {
            $mqtt->subscribe($topic, function($topic, $message) use ($event) {
                $event->dispatch(new MQTTReceived($topic, $message));
            });
        }
        $mqtt->loop(true);
    }
}
