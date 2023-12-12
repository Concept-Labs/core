<?php
//PSR-14
namespace Cl\Event;

interface StoppableEventInterface
{
    public function isPropagationStopped() : bool;
}