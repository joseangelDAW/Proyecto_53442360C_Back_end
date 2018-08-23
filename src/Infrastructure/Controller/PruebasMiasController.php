<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 9/07/18
 * Time: 12:00
 */

namespace App\Infrastructure\Controller;

use App\Infrastructure\Events\SomethingHappenedEvent;
use App\Infrastructure\PruebasMias\FooEventsThrown;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PruebasMiasController extends Controller

{
    /**
     * @param EventDispatcherInterface $dispatcher
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function addListeners(
        EventDispatcherInterface $dispatcher
    ) {
//        $listener = new FooActionListener();
//        $dispatcher->addListener(
//            'something_happened',
//            array ($listener, 'onSomethingHappenedEvent')
//            );
//
//        $dispatcher->dispatch('something_happened', new SomethingHappenedEvent('Arthur', 'hitchhiking'));

        return $this->json(["addListeners Ok"]);
    }

    /**
     * @param EventDispatcherInterface $dispatcher
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function dispatchEvent(
        EventDispatcherInterface $dispatcher
    ) {
        FooEventsThrown::instance()->trigger(new SomethingHappenedEvent('Jose Angel', 'programando'));
        FooEventsThrown::instance()->trigger(new SomethingHappenedEvent('Javi', 'programando'));

//        $dispatcher->dispatch('event.happened', new SomethingHappenedEvent('Arthur', 'hitchhiking'));
        $events = FooEventsThrown::instance()->getEvents();
        foreach ($events as $event)
        {
            $dispatcher->dispatch('event.happened', $event);
        }
//        $events = $this->getEvents();

        return $this->json(["Eventos: \n".var_dump($events)]);
    }
}