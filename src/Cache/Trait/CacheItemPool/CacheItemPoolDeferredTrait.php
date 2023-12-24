<?php
namespace Cl\Cache\Trait\CacheItemPool;

use Psr\Cache\CacheItemInterface;

/**
 * Trait providing deferred cache item saving functionality.
 */
trait CacheItemPoolDeferredTrait
{

    /**
     * @var array The array to store deferred cache items.
     */
    protected array $deferred = [];

    /**
     * Checks if a deferred item with the given key exists.
     *
     * @param string $key The key to check.
     * 
     * @return bool True if a deferred item with the key exists; otherwise, false.
     */
    public function hasDeferred(string|\Stringable $key): bool
    {
        return array_key_exists($key, $this->deferred);
    }

    /**
     * Save a cache item in a deferred state.
     *
     * @param CacheItemInterface $item The cache item to save.
     * 
     * @return bool True if the item was successfully saved; otherwise, false.
     */
    public function saveDeferred(CacheItemInterface $item): bool
    {
        $this->deferred[$item->getKey()] = clone $item;
        return true;
    }

    /**
     * Commit all deferred cache items.
     *
     * @return bool True if all deferred items were successfully committed; otherwise, false.
     */
    public function commit(): bool
    {
        return array_reduce(
            $this->deferred, fn($carry, $item) => $carry && $this->save($item), 
            true
        );
    }    
}