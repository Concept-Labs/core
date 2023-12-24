<?php
namespace Cl\Cache;

use Cl\Cache\CacheItemPoolInterface as ClCacheItemPoolInterface;
use Cl\Cache\Trait\CacheItem\CacheItemKeyValidatorTrait;
use Cl\Cache\Trait\CacheItemPool\CacheItemPoolAbstractTrait;
use Cl\Cache\Trait\CacheItemPool\CacheItemPoolDeferredTrait;
use Cl\Cache\Trait\CacheKeyNormalizerTrait;

/**
 * Abstract class for implementing 
 * the ClCacheItemPoolInterface (Psr\Cache\CacheItemPoolInterface) interface.
 */
abstract class CacheItemPoolAbstract implements ClCacheItemPoolInterface
{
    use CacheItemPoolAbstractTrait;
    use CacheItemPoolDeferredTrait;
    use CacheKeyNormalizerTrait;
    use CacheItemKeyValidatorTrait;

    protected bool $frozen = false;

    /**
     * Get cache items by their keys.
     *
     * @param array $keys An array of keys.
     *
     * @return iterable An iterator containing CacheItemInterface objects.
     */
    public function getItems(array $keys = []): iterable
    {   
        foreach ($keys as $key) {
            yield $this->validateKey($key)
                ->getItem($key);
        }
    }

    /**
     * Delete cache items by their keys.
     *
     * @param array $keys An array of keys.
     *
     * @return bool Returns true if all items were successfully deleted.
     */
    public function deleteItems(array $keys): bool
    {

        return array_reduce(
            $keys,
            fn($carry, $key) 
                => $carry && $this->validateKey($key) && $this->deleteItem($key),
            true
        );
    }
}