<?php

namespace Cl\Di;

use Cl\Di\AwareReflectionTrait;

trait AwareInjectableTrait
{
    use AwareReflectionTrait;

    public function getSelfClone(): self
    {
        $instance = clone $this;
        return $instance;
    }

}