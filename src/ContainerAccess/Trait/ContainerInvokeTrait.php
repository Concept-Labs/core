<?php
namespace Cl\ContainerAccess\Trait;

trait ContainerInvokeTrait
{
    use ContainerTrait;
    /**
     * Invoke
     *
     * @param array|null $data 
     * 
     * @return array|\Traversable
     */
    public function __invoke(?array $data = null)
    {
        $containerRef = $this->getContainerAccessPropertyRef();
        if ($data !== null) {
            $this->setContainerAccessProperty($data);
        }
        return $containerRef;
    }
}