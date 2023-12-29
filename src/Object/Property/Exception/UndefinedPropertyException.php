<?php
/**
 * Exception thrown when trying to access an undefined property of an object.
 *
 * @category  Library
 * @package   Cl\Object\Property
 * @author    Victor Galitsky <concept.galitsk@gmail.com>
 * @copyright 2023 (C)oncept-labs
 * @license   MIT 
 * @link      g
 */
namespace Cl\Object\Property;

use Cl\Object\ObjectException;

/**
 * {@inheritDoc}
 */
class UndefinedPropertyException extends ObjectException 
    implements UndefinedPropertyExceptionInterface
{
}
