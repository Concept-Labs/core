<?php
/**
 * PSR-6 InvalidArgumentExceptionInterface
 * 
 * @category  Library
 * @package   Cl\Cache
 * @author    Victor Galitsky <concept.galitsk@gmail.com>
 * @copyright 2023 (C)oncept-labs
 * @license   MIT 
 * @link      g
 */
namespace Cl\Cache\Exception;

use Psr\Cache\InvalidArgumentException as PsrCacheInvalidArgumentException;

/**
 * {@inheritDoc}
 */
interface InvalidArgumentExceptionInterface extends PsrCacheInvalidArgumentException
{
}
