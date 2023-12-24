<?php
namespace Cl\Cache\Trait;

use Cl\Cache\Exception\InvalidArgumentException;
use Cl\Cache\Trait\CacheItem\CacheItemKeyValidatorTrait;
use Cl\Closure\Closure;

/**
 * Trait providing key encoding and decoding functionality.
 */
trait CacheKeyNormalizerTrait
{
    use CacheItemKeyValidatorTrait;

    /**
     * Extract a cache item key.
     *
     * @param string|\Stringable|callable $key The cache item key.
     *
     * @return string The extracted cache item key.
     * @throws InvalidArgumentException If the key is of an invalid type.
     */
    protected function normalizeKey(string|\Stringable|callable $key): string
    {
        $key = match (true) {
            is_string($key) || $key instanceof \Stringable => (string)$key,
            is_callable($key) => Closure::invokeCallable($key),
            default => throw new InvalidArgumentException('Invalid key type'),
        };

        $this->validateKey($key);
        return $key;
    }

    
}