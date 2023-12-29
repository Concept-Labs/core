<?php

namespace Cl\Object\Instance\Able\Trait;

trait FromArrayTrait
{
    /**
     * {@inheritDoc}
     * @see Cl\Object\Instance\Able\Interface\FromArrayableInterface
     */
    public static function fromArray(array $data): static
    {
        return new static(...$data);
    }
}