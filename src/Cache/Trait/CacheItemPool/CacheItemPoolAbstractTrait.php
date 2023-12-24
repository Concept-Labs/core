<?php
namespace Cl\Cache\Trait\CacheItemPool;

use Cl\Cache\CacheItemInterface;
use Psr\Cache\CacheItemInterface as PsrCacheItemInterface;

trait CacheItemPoolAbstractTrait
{
    /**
     * Save a cache item to the pool.
     *
     * @param PsrCacheItemInterface $item The cache item to save.
     *
     * @return bool True on success, false on failure.
     */
    abstract public function save(PsrCacheItemInterface $item): bool;

    /**
     * Check if a cache item with the given key exists in the pool.
     *
     * @param string|\Stringable $key The key of the cache item to check.
     *
     * @return bool True if the cache item exists, false otherwise.
     */
    abstract public function hasItem(string|\Stringable $key): bool;

    /**
     * Retrieve a cache item from the pool by key.
     *
     * @param string|\Stringable $key The key of the cache item to retrieve.
     *
     * @return CacheItemInterface The retrieved cache item.
     */
    abstract public function getItem(string|\Stringable $key): CacheItemInterface;

    /**
     * Delete a cache item from the pool by key.
     *
     * @param string|\Stringable $key The key of the cache item to delete.
     *
     * @return bool True on success, false on failure.
     */
    abstract public function deleteItem(string|\Stringable $key): bool;

    /**
     * Clear all cache items from the pool.
     *
     * @return bool True on success, false on failure.
     */
    abstract public function clear(): bool;
}