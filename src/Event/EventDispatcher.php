<?php
namespace Cl\Core\Event;
class EventDispatcher implements EventDispatcherInterface
{

    /**
     * Listener provider
     *
     * @param ListenerProviderInterface $provider
     */
    protected $provider

    public function __construct(ListenerProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function dispatch(object $event)
    {
        foreach ($this->provider->getListenersForEvent($event) as $listener) {
            //@TODO
            $listener($event);
        }
       return $event;
    }
}