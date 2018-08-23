<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 9/07/18
 * Time: 11:58
 */

namespace App\Infrastructure\PruebasMias;

use Symfony\Component\EventDispatcher\Event;

class FooEventsThrown
{
    private static $instance;
    private $events;

    private function __construct()
    {
    }

    public static function instance(): self
    {
        if(null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function printName (string $name): string
    {
        return "Hola ".$name;
    }

    public function trigger (Event $event)
    {
        $this->events[] = $event;
    }

    public function getEvents()
    {
        return $this->events;
    }
}