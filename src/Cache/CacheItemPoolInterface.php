<?php
/**
 * PSR-6 CacheItemPoolInterface
 * 
 * @category  Library
 * @package   Cl\Cache
 * @author    Victor Galitsky <concept.galitsk@gmail.com>
 * @copyright 2023 (C)oncept-labs
 * @license   MIT 
 * @link      g
 */
namespace Cl\Cache;

use \Psr\Cache\CacheItemPoolInterface as PsrCacheItemPoolInterface;

/**
 * {@inheritDoc}
 */
interface CacheItemPoolInterface extends PsrCacheItemPoolInterface
{

    public function freeze(): CacheItemPoolInterface;

    public function unfreeze(): CacheItemPoolInterface;
    
}