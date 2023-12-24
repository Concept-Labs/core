<?php
/**
 * PSR-6 CacheExceptionInterface
 * 
 * @category  Library
 * @package   Cl\Cache
 * @author    Victor Galitsky <concept.galitsk@gmail.com>
 * @copyright 2023 (C)oncept-labs
 * @license   MIT 
 * @link      g
 */
namespace Cl\Cache\Exception;

use Psr\Cache\CacheException as PsrCacheExceptionInterface;

/**
 * {@inheritDoc}
 */
interface CacheExceptionInterface extends  PsrCacheExceptionInterface
{
}
