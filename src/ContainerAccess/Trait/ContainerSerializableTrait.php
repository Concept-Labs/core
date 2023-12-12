<?php
namespace Cl\ContainerAccess\Trait;

use Cl\ContainerAccess\Trait\ContainerTrait;

trait ContainerSerializableTrait
{
    use ContainerTrait;
    public function serialize()
    {
        return json_encode($this->getContainerAccessPropertyRef());
    }
    public function unserialize(string $data)
    {
        $this->setContainerAccessProperty(json_decode($data));
    }
}