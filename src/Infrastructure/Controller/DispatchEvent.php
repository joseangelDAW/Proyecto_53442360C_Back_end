<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 8/07/18
 * Time: 22:46
 */

namespace App\Infrastructure\Controller;

use App\Infrastructure\Events\SomethingHappenedEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DispatchEvent
{
    private $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function dispatchEvent ()
    {
        $this->dispatcher->dispatch('something_happened', new SomethingHappenedEvent('Arthur', 'hitchhiking'));
    }
}