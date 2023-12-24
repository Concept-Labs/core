<?php

namespace Cl\Cache;

use Cl\Cache\Trait\CacheItem\CacheItemTrait;

/**
 * Abstract class for implementing the CacheItemInterface interface.
 */
abstract class CacheItemAbstract implements CacheItemInterface
{
    use CacheItemTrait;

    /**
     * CacheItemAbstract constructor.
     *
     * @param string|\Stringable          $key          The key associated 
     *                                                  with the cache item.
     * @param mixed                       $value        The value to be stored 
     *                                                  in the cache item.
     * @param \DateTimeInterface|int|null $expiresAfter The expiration time 
     *                                                  or duration in seconds.
     * @param mixed                       $extra        Additional data to associate 
     *                                                  with the cache item.
     */
    public function __construct(
        string|\Stringable $key,
        mixed $value = null,
        \DateTimeInterface|int $expiresAt = null,
        mixed $extra = []
    ) {
        $this
            ->setKey($key)
            ->setValue($value)
            ->setHit(true)
            ->expiresAt($expiresAt)
            ->setExtra($extra);
    }
}