<?php
//PSR-14
namespace Cl\Core\Event;

interface EventDispatcherInterface
{
    public function dispatch(object $event);
}