<?php

namespace App\Event;

class MQTTReceived
{
    public string $topic;
    public string $message;

    public function __construct(string $topic, ?string $message) {
        $this->topic = $topic;
        $this->message = $message;
    }
}