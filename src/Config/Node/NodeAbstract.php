<?php
namespace Cl\Core\Config\Node;

class NodeAbstract implements NodeInterface, \ArrayAccess, \IteratorAggregate
{
    protected $nodeData = [];
    //protected $keys;
    //protected $position;

    public function __construct(array $nodeData = [])
    {
        $this->nodeData = $nodeData;
    }

    public function &__invoke(): array
    {
        return $this->nodeData;
    }

    public function __get($offset): mixed
    {
        return $this->offsetGet($offset);
    }

    public function __set($offset, $value)
    {
        $this->offsetSet($offset, $value);
    }

    public function __isset($offset): bool
    {
        return $this->offsetExists($offset);
    }
    public function __unset($name): void
    {
        $this->offsetUnset($name);
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->nodeData[] = $value;
        } else {
            $this->nodeData[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->nodeData[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->nodeData[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return isset($this->nodeData[$offset]) ? $this->nodeData[$offset] : null;
    }

    public function getIterator(): \Traversable
    {
        return (function () {
            foreach ($this->nodeData as $key => $value) {
                yield $key => $value;
            }
        })();
    }




}