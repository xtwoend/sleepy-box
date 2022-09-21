<?php

namespace App\IOT;

class Command
{
    const HIGH = 1;
    const LOW = 0;

    public static function exec(...$args)
    {
        $args = implode(" ", $args);
        $cmd = shell_exec($args);

        return $cmd;
    }
}