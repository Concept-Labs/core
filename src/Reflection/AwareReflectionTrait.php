<?php
namespace Cl\Reflection;

trait AwareReflectionTrait
{
    protected \ArrayAccess|array $reflectionMetaData;
    protected \ReflectionObject $reflectionObject = null;
    protected static \ReflectionClass $reflectionClass = null;

    /**
     * Get ReflectionClass instance
     *
     * @return \ReflectionClass
     */
    public static function getReflectionClass(): \ReflectionClass
    {
        if (self::$reflectionClass === null) {
            self::$reflectionClass = new \ReflectionClass(static::class);
        }
        return self::$reflectionClass;
    }

    /**
     * Get Reflection Object
     *
     * @return \ReflectionObject
     */
    public function getReflectionObject(): \ReflectionObject
    {
        if (!$this->reflectionObject instanceof self) {
            $this->reflectionObject = new \ReflectionObject($this);
        }
        return $this->reflectionObject;
    }

    /**
     * Get Reflection MetaData
     *
     * @return \ArrayAccess|array
     */
    public function getReflectionMetaData()
    {
        return $this->reflectionMetaData;
    }
}