<?php
/**
 * Factory
 */
namespace Cl\Factory;

use Cl\Log\Log;

/**
 * Class Factory
 */
class Factory
{
    /**
     * Factoried entites
     *
     * @var \Cl\Object\Storage
     */
    //protected static $objectStorage;

    protected static $entities = [];


    /**
     * Invoke function
     *
     * @param string $class   class to factory
     * @param mixed  ...$args constructor arguments
     * 
     * @return void
     */
    public function __invoke(string $class, ...$args)
    {
        return static::factory($class, ...$args);
    }

    /**
     * Factory method
     * 
     * @param string $class   Class name to factory
     * @param mixed  ...$args Argument for constructor
     * 
     * @return mixed
     */
    public static function factory(string $class, ...$args): \Cl\Factory\FactorableInterface
    {
        $that = $class;
        $entity = null;

        //$class = static::rewrite($class);

        if (method_exists($class, 'factory')) {
            $entity = $class::factory(...$args);
        } else {
            try {
                $entity = new $class(...$args);
            } catch (\Throwable $e) {
                $msg = "Factory exception ('{$class}'): {$e->getMessage()}";
                Log::logException(
                    $msg,
                    Log::LEVEL_ERROR,
                    'cl.factory.exception.log'
                );
                throw new \Exception($msg);
            }
        }

        $entity->___factory = [
            "rewrite" => ($that != $class) ? $that : false,
        ];
        static::validate($entity);
        static::$entities[$class][] = &$entity;

        return $entity;
    }

    /**
     * @param string $class
     * @param mixed ...$args
     * @return mixed
     */
    public static function singleton(string $class, ...$args): mixed
    {
        if (isset(static::$entities[$class])
            && is_object(static::$entities[$class][0])
            && static::$entities[$class][0] instanceof $class
        ) {
            return static::$entities[$class][0];
        }
        return static::factory($class, ...$args);
    }

    /**
     * class write. see config
     *
     * @param string $class
     * @return string
     */
    public static function rewrite(string $class)
    {
        $rewrites = Config::node(Factory::CFG_NODE_REWRITE);
        foreach (($rewrites ?: []) as $from => $to) {
            if ($class == $from) {
                return isset($to['class']) ? $to['class'] : false;
            }
        }
        return $class;
    }

    /**
     * @param mixed $entity
     * @return void
     */
    public static function validate(mixed $entity)
    {
        if (method_exists($entity, '___validate')) {
            $entity->___validate();
        }
    }
}