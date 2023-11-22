<?php
namespace Cl\Core\Di;

class SingletonRepository implements Iface\RepositoryInterface
{
    /**
     * Repository
     *
     * @var array
     */
    protected static $repositoryStorage = [];
    protected static $factory;

    public function __construct($factory FactoryInterface)
    {
        static::$factory = $factory;
    }
    public static function add(object $entity): void
    {
        if (!isset(static::$repositoryStorage[$entity::class])) {
            static::$repositoryStorage[$entity::class] = &$entity;
        }
    }

    public static function getInstance(string $class): object|null
    {
        return isset(static::$repositoryStorage[$class]) ?? null;
    }

}