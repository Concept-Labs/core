<?php
/**
 * Implementation of PSR-6 CacheExceptionInterface
 * 
 * @category  Library
 * @package   Cl\Cache
 * @author    Victor Galitsky <concept.galitsk@gmail.com>
 * @copyright 2023 (C)oncept-labs
 * @license   MIT 
 * @link      g
 */
namespace Cl\Cache\Exception;


/**
 * {@inheritDoc}
 */
class CacheException extends \Exception implements CacheExceptionInterface
{
}
