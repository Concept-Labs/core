<?php
namespace Cl\ContainerAccess\Trait;

trait ContainerAllTrait
{
    use ContainerTrait;
    use ContainerAccessTrait;
    use ContainerIteratorAgregateTrait;
    use ContainerGetterTrait;
    use ContainerSetterTrait;
    use ContainerInvokeTrait;
    use ContainerStringableTrait;
    use ContainerSerializableTrait;
}