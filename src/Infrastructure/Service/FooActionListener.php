<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 7/07/18
 * Time: 23:01
 */

namespace App\Infrastructure\Service;

use App\Infrastructure\Events\SomethingHappenedEvent;

class FooActionListener
{
    public function onSomethingHappenedEvent(SomethingHappenedEvent $event)
    {
        echo "{$event->who()} was {$event->what()} at {$event->when()->format('Y/m/d H:i:s')}\n";
    }
}