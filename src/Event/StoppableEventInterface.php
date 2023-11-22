<?php
//PSR-14
namespace Cl\Core\Event;

interface StoppableEventInterface
{
    public function isPropagationStopped() : bool;
}