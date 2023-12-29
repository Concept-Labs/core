<?php
/**
 * Property Access. 
 * use instead of: "PHP 8.2: Dynamic Properties are deprecated"
 * 
 * @category  Library
 * @package   Cl\Object
 * @author    Victor Galitsky <concept.galitsk@gmail.com>
 * @copyright 2023 (C)oncept-labs
 * @license   MIT 
 * @link      g
 */

namespace Cl\Object\Property;

use Cl\Closure\Closure;

//#[AllowDynamicProperties]
interface PropertyAccessableInterface
{

    /**
     * Get the value of a property.
     *
     * @param string|\Stringable $property The name of the property.
     *
     * @return mixed The value of the property.
     * @throws UndefinedPropertyException if the property does not exist.
     */
    protected function getProperty(string|\Stringable $property): mixed;

    /**
     * Set the value of a property.
     *
     * @param string|\Stringable $property The name of the property.
     * @param mixed              $value    The value to set.
     *
     * @return static The current object.
     * @throws UndefinedPropertyException if the property does not exist.
     */
    protected function setProperty(string|\Stringable $property, mixed $value): static;

    /**
     * Wrap a property value using a closure.
     *
     * @param mixed $value The value to wrap.
     *
     * @return mixed The wrapped value.
     */
    protected function wrapPropertyValue(mixed $value): mixed;
}