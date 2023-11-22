<?php
/**
 * Factorable
 */
namespace Cl\Core\Factory;

/**
 * Factorable interface
 */
interface FactorableInterface
{
    /**
     * Factory
     *
     * @param mixed ...$args factorable object constructor arguments
     * 
     * @return Factorable
     */
    public static function factory(mixed ...$args);
}