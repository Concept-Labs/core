<?php
namespace Cl\ContainerAccess\Trait;

trait ContainerGetterTrait
{
    use ContainerAccessTrait;
    
    public function __get($offset): mixed
    {
        return $this->offsetGet($offset);
    }
    public function __isset($offset): bool
    {
        return $this->offsetExists($offset);
    }
}