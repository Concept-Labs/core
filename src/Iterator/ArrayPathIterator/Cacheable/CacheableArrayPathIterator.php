<?php
namespace Cl\Iterator\ArrayPathIterator\Cacheable;

use Cl\Cache\CacheItemPoolInterface;
use Cl\Iterator\ArrayPathIterator\ArrayPathIterator;
use Cl\Iterator\ArrayPathIterator\ArrayPathIteratorInterface;

/**
 * Cacheable ArrayPathIterator
 */
class CacheableArrayPathIterator extends ArrayPathIterator implements CacheableArrayPathIteratorInterface
{
    /**
     * Trait for implementation CacheableArrayPathIteratorInterface 
     */
    use CacheableArrayPathIteratorTrait;

    /**
     * CacheableArrayPathIterator constructor.
     *
     * @param CacheItemPoolInterface $cacheItemPool 
     * @param array                  $data 
     * @param int                    $flags 
     */
    public function __construct(CacheItemPoolInterface $cacheItemPool, array $data, int $flags = 0)
    {
        parent::__construct($data, $flags);

        $this->setCacheItemPool($cacheItemPool);
    }

    /**
     * {@inheritDoc}
     */
    public function getChild(array $data, string $path,): ArrayPathIteratorInterface
    {
        $cacheItemPool = $this->getCacheItemPool();
        return new static($cacheItemPool, $data, $path);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet(mixed $key): mixed
    {
        if (!$result = $this->offsetCacheGet((string)$key)) {
            $result = parent::offsetGet((string)$key);
            if (!$this->offsetCacheSave((string)$key, $result)) {
                trigger_error(sprintf('Could not save the cache item "%s"', (string)$key), E_USER_WARNING);
            }
        }
        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet(mixed $key, mixed $value): void
    {
        parent::offsetSet($key, $value);
        if (!$this->offsetCacheDelete((string)$key)) {
            trigger_error(sprintf('Could not delete the cache item "%s"', (string)$key), E_USER_WARNING);
        }
    }
}