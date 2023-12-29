<?php
namespace Cl\Iterator;

use Cl\Iterator\IteratorAgregate\IteratorAgregateDataProperty;

/**
 * \IteratorAggregate::getIterator() generator implementation for value
 * 
 * @see trait IteratorAgregateDataProperty::getIteratorAgregateDataPropertyName()
 */
trait IteratorAgregateValueGeneratorTrait
{

    use IteratorAgregateDataProperty;
    
    /**
     * @see \IteratorAggregate::getIterator()
     */
    public function getIterator(): \Traversable
    {
        foreach ($this->{$this->getIteratorAgregateDataPropertyName()} as $value) {
            yield $value;
        }
    }
}