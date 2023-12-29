<?php
namespace Cl\Type\Iterator\IteratorAgregate;

use Cl\Iterator\IteratorAgregate\Exception\InvalidArgumentException;
use Cl\Iterator\IteratorAgregate\Exception\InvalidPropertyException;
use Cl\Iterator\IteratorAgregate\Exception\PropertyNotInitializedException;


trait IteratorAgregateDataPropertyTrait
{
    /**
     * The property to store the property name used as data for iterator
     *
     * @var string
     */
    protected string $iteratorAgregateDataPropertyName;

    /**
     * Set the property name used for IteratorAgregate::getIterator()
     *
     * @param string|\Stringable $propertyName The name of the property
     * 
     * @return static
     */
    protected function setIteratorAgregateDataPropertyName(string|\Stringable $propertyName) : static
    {
        if (!property_exists(static::class, $propertyName)) {
            throw new InvalidPropertyException(sprintf('Property "%s" not exists'));
        }
        if (!strlen($propertyName) > 0) {
            throw new InvalidArgumentException(sprintf('Property name must contain not empty string'));
        }
        $this->iteratorAgregateDataPropertyName = (string)$propertyName;

        return $this;
    }

    /**
     * Get the property name for IteratorAgregate::getIterator()
     *
     * @return string
     */
    protected function getIteratorAgregateDataPropertyName() : string
    {
        if (is_null($this->iteratorAgregateDataPropertyName)) {
            throw new PropertyNotInitializedException("Property name for IteratorAgregate is not initialized. use setIteratorAgregateDataPropertyName()");
        }
        return $this->iteratorAgregateDataPropertyName;
    }
}