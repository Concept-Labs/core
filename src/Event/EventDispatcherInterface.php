<?php
//PSR-14
namespace Cl\Event;

interface EventDispatcherInterface
{
    public function dispatch(object $event);
}