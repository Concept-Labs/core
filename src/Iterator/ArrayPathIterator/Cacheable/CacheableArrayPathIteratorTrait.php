<?php
namespace Cl\Iterator\ArrayPathIterator\Cacheable;

use Cl\Cache\CacheItemPoolInterface;

/**
 * Trait for CacheableArrayPathIterator
 */
trait CacheableArrayPathIteratorTrait
{
    /**
     * Cache storage
     *
     * @var CacheItemPoolInterface
     */
    protected CacheItemPoolInterface $cacheItemPool;
    
    /**
     * {@inheritDoc}
     */
    public function getCacheItemPool() : CacheItemPoolInterface
    {
        return $this->cacheItemPool;
    }

    /**
     * {@inheritDoc}
     */
    public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool) : CacheableArrayPathIteratorInterface
    {
        $this->cacheItemPool = $cacheItemPool;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCacheKey(string $key): string
    {
        return md5(
            serialize(
                [
                    'key' => $key,
                    'path' => $this->getPath(),
                    'separator' => $this->getSeparator(),
                    'flags' => $this->getFlags(),
                ]
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function offsetCacheGet(string $key) : mixed
    {
        $cacheKey = $this->getCacheKey($key);
        return $this->getCacheItemPool()->getItem($cacheKey)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function offsetCacheSave(string $key, mixed $value): bool
    {
        
        // Save the cached value
        $cacheKey = $this->getCacheKey($key);
        return $this->getCacheItemPool()->save(
            $this->getCacheItemPool()->getItem($cacheKey)->set($value)
        );
    }

    /**
     * {@inheritDoc}
     */
    public function offsetCacheDelete(string $key): bool
    {
        $cacheKey = $this->getCacheKey($key);
        return $this->getCacheItemPool()->deleteItem($cacheKey);
    }

    /**
     * {@inheritDoc}
     */
    public function cacheClear(): bool
    {
        return $this->getCacheItemPool()->clear();
    }

}