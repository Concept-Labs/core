<?php
declare(strict_types=1);
namespace Cl\ContainerAccess\Trait;


use Cl\ContainerAccess\Exception\ContainerNotValidException;

/**
 * Implementation of @see Cl\ContainerAccess\Interface\ContainerInterface
 */
trait ContainerTrait
{
    const CONTAINER_ACCESS_CONTAINER_PROPERY_DEFAULT = 'containerAccess_Container';

    /**
     * Container
     *
     * @var \Traversable|array
     */
    protected \Traversable|array $containerAccess_Container = [];

    /**
     * Traversable container property name
     *
     * @var string|\Stringable
     */
    protected string $containerAccess_Container_PropertyName = self::CONTAINER_ACCESS_CONTAINER_PROPERY_DEFAULT;

    /**
     * @see Cl\ContainerAccess\Interface\ContainerInterface
     */
    public function setContainerAccessPropertyName(string|\Stringable $propertyName): void
    {
        $this->containerAccess_Container_PropertyName = $propertyName;
    }

    /**
     * @see Cl\ContainerAccess\Interface\ContainerInterface
     */
    public function getContainerAccessPropertyName(): \Stringable|string
    {
        return $this->containerAccess_Container_PropertyName;
    }

    /**
     * @see Cl\ContainerAccess\Interface\ContainerInterface
     */
    protected function &getContainerAccessPropertyRef(): \Traversable|array
    {
        $this->assertContainerAccessProperty();
        /** @var $container \Traversable */
        $container = &$this->{$this->getContainerAccessPropertyName()};
        return $container;
    }

    protected  function setContainerAccessProperty(\Traversable|array $data): void
    {

        $this->assertContainerAccessProperty($data);
        $this->{$this->getContainerAccessPropertyName()} = $data;
    }

    /**
     * @see Cl\ContainerAccess\Interface\ContainerInterface
     */
    protected function assertContainerAccessProperty(\Traversable|array $data = null): void
    {
        $assertion = $data !== null ? $data : $this->{$this->getContainerAccessPropertyName()};
        if (!is_array($assertion)
            //|| !$this->{$this->containerAccess_Container_PropertyName} instanceof \Traversable
        ) {
            throw new ContainerNotValidException(
                sprintf(
                    "Container data type must be \Traversable or array. Container property name: %s::%s ",
                    get_class($this),
                    $this->getContainerAccessPropertyName()
                )
            );
        }
    }
}