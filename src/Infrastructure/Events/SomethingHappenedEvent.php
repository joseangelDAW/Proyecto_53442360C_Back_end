<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 7/07/18
 * Time: 19:49
 */

namespace App\Infrastructure\Events;

use Symfony\Component\EventDispatcher\Event;

class SomethingHappenedEvent extends Event
{
    private $who;
    private $what;
    private $when;

    public function __construct($who, $what)
    {
        $this->who = $who;
        $this->what = $what;
        $this->when = new \DateTimeImmutable();
    }

    public function who()
    {
        return $this->who;
    }

    public function what()
    {
        return $this->what;
    }

    public function when()
    {
        return $this->when;
    }
}