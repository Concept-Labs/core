<?php
//PSR-14
namespace Cl\Event;

interface ListenerProviderInterface
{
    public function getListenersForEvent(object $event) : iterable;
}