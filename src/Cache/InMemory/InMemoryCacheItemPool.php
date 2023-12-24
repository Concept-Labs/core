<?php
namespace Cl\Cache\InMemory;

use Cl\Cache\CacheItemInterface;
use Cl\Cache\CacheItemPoolAbstract;
use Psr\Cache\CacheItemInterface as PsrCacheItemInterface;

/**
 * Class with implementation 
 * the ClCacheItemPoolInterface (Psr\Cache\CacheItemPoolInterface) interface
 * with in-memory storage
 */
class InMemoryCacheItemPool extends CacheItemPoolAbstract
{
    /**
     * Cache storage
     *
     * @var array
     */
    protected array $cache = [];

    /**
     * @inheritDoc
     */
    public function save(PsrCacheItemInterface $item): bool
    {
        $this->cache[$item->getKey()] = clone $item;
        return true;
    }

    /**
     * @inheritDoc
     */
    public function hasItem(string|\Stringable $key): bool
    {
        return array_key_exists($this->normalizeKey($key), $this->cache);
        // || $this->hasDeferred($cacheKey);
    }

    /**
     * @inheritDoc
     */
    public function getItem(string|\Stringable $key, mixed $defaultValue = null): CacheItemInterface
    {
        $cacheKey = $this->normalizeKey($key);
        return match (true) {
            $this->hasDeferred($cacheKey) => clone $this->deferred[$cacheKey],
            $this->hasItem($key) => clone $this->cache[$cacheKey],
            //@TODO
            default => (new InMemoryCacheItem($cacheKey, $defaultValue))
        };
    }

    /**
     * @inheritDoc
     */
    public function deleteItem(string|\Stringable $key): bool
    {
        unset($this->cache[$this->normalizeKey($key)]);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function clear(): bool
    {
        return array_reduce(
            $this->cache,
            fn($carry, $item) => $carry && $this->deleteItem($item->getKey),
            true
        );
    }

}