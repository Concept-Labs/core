<?php

namespace Cl\Object\Instance;

trait FromArrayTrait
{
    /**
     * Create an instance of the class from an array of values.
     *
     * @param array $data The array of values.
     *
     * @return static The created instance.
     */
    public static function instanceFromArray(array $data): static
    {
        return new static(...$data);
    }
}