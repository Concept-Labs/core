<?php
namespace Cl\ContainerAccess\Interface;

interface ContainerInterface
{
    /**
     * Set container property name
     *
     * @param \Stringable $propertyName 
     * 
     * @return void
     */
    public function setContainerAccessPropertyName(\Stringable $propertyName): void;

    /**
     * Get container property name
     * 
     * @return \Stringable
     */
    public function getContainerAccessPropertyName(): \Stringable;

    /**
     * Get container reference
     *
     * @return \Traversable
     * @throws Cl\ContainerAccess\Exception\ContainerNotValidException
     */
    protected  function &getContainerAccessPropertyRef(): \Traversable|array;

    /**
     * Set container data
     *
     * @param \Traversable|array $data
     * @return void
     */
    protected  function setContainerAccessProperty(\Traversable|array $data): void;

    /**
     * Check if container property is valid
     * 
     * @return void
     * @throws Cl\ContainerAccess\Exception\ContainerNotValidException
     */
    protected function assertContainerAccessProperty(): void;
}