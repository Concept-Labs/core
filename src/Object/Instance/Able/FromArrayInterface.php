<?php
namespace Cl\Object\Instance\Able\Interface;

interface FromArrayableInterface
{
    /**
     * Create an instance of the class from an array of values.
     *
     * @param array $data The array of values.
     *
     * @return static The created instance.
     */
    public static function fromArray(array $data): static;
}