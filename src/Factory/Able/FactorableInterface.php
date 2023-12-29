<?php
/**
 * Factorable
 */
namespace Cl\Factory\Able;

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
     * @return FactorableInterface
     */
    public static function factory(mixed ...$args): FactorableInterface;
}