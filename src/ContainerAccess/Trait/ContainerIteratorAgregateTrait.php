<?php
namespace Cl\ContainerAccess\Trait;

trait ContainerIteratorAgregateTrait
{
    use ContainerTrait;

    /**
     * @see \IteratorAgregate
     *
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        return (function () {
            foreach ($this->getContainerAccessPropertyRef() as $key => $value) {
                yield $key => $value;
            }
        })();
    }
}