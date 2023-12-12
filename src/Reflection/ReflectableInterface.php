<?php
namespace Cl\Reflection;
use Cl\Traitable\TraitableInterface;

interface ReflectableInterface extends TraitableInterface
{
    /**
     *
     * @property \ArrayAccess|array $reflectionMetaData
     * @property \ReflectionObject $reflectionObject
     * @property \ReflectionClass $reflectionClass
     */
    
    public static function getReflectionClass(): \ReflectionClass;
    public function getReflectionObject(): \ReflectionObject;
    public function getReflectionMetaData(): \Traversable;
}