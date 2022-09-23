<?php

namespace App\IOT;

class Command
{
    const HIGH = 1;
    const LOW = 0;

    const DOOR = 16;
    const LAMP = 15;

    public function __construct() {
        $this->init();
    }

    public function command($command)
    {
        $cmd = json_decode($command);

        if($cmd && isset($cmd['door'])) {
            $status = $cmd['door'];
            $this->exec(['gpio', 'write', self::DOOR, (int) $status]);
        }elseif($cmd && $cmd['door']) {
            $status = $cmd['lamp'];
            $this->exec(['gpio', 'write', self::LAMP, (int) $status]);
        }
    }

    public function exec(...$args)
    {
        $args = implode(" ", $args);
        $cmd = shell_exec($args);

        return $cmd;
    }
    
    public function init()
    {
        $door = self::DOOR;
        $lamp = self::LAMP;

        shell_exec("gpio mode {$door} out");
        shell_exec("gpio mode {$lamp} out");
    }
}