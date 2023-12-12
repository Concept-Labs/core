<?php
namespace Cl\ContainerAccess\Trait;

use Cl\ContainerAccess\Trait\ContainerTrait;

trait ContainerStringableTrait
{
    use ContainerTrait;
    use ContainerSerializableTrait;
   
    public function __toString()
    {
        return $this->serialize();
    }
}