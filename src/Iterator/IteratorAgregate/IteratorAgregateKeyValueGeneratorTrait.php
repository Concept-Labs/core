<?php
namespace Cl\Iterator\IteratorAgregate;


/**
 * \IteratorAggregate::getIterator() generator implementation for $key => value pair
 * 
 * @see trait IteratorAgregateDataProperty::getIteratorAgregateDataPropertyName()
 */
trait IteratorAgregateKeyValueGeneratorTrait
{
    use IteratorAgregateDataProperty;

    /**
     * @see \IteratorAggregate::getIterator()
     */
    public function getIterator(): \Traversable
    {
        foreach (
            $this->{$this->getIteratorAgregateDataPropertyName()} as $key => $value
        ) {
            yield [$key => $value];
        }
    }
}