<?php
namespace Cl\ContainerAccess\Trait;

trait ContainerAccessTrait
{
    use ContainerTrait;

    /**
     * @see \ArrayAcces
     */
    public function offsetExists($offset): bool
    {
        return isset($this->getContainerAccessPropertyRef()[$offset]);
    }

    /**
     * @see \ArrayAcces
     */
    public function offsetGet($offset): mixed
    {
        return isset($this->getContainerAccessPropertyRef()[$offset]) ? $this->getContainerAccessPropertyRef()[$offset] : null;
    }

    /**
     * @see \ArrayAcces
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->getContainerAccessPropertyRef()[] = $value;
        } else {
            $this->getContainerAccessPropertyRef()[$offset] = $value;
        }
    }

    /**
     * @see \ArrayAcces
     */
    public function offsetUnset($offset): void
    {
        unset($this->getContainerAccessPropertyRef()[$offset]);
    }

}