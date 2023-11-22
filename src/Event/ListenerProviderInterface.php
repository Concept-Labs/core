<?php
//PSR-14
namespace Cl\Core\Event;

interface ListenerProviderInterface
{
    public function getListenersForEvent(object $event) : iterable;
}