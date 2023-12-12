<?php
namespace Cl\ContainerAccess\Trait;

trait ContainerSetterTrait
{
    use ContainerAccessTrait;
    public function __set($offset, $value)
    {
        $this->offsetSet($offset, $value);
    }
    public function __unset($name): void
    {
        $this->offsetUnset($name);
    }
}