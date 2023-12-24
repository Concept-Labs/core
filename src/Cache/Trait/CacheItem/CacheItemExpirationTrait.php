<?php
namespace Cl\Cache\Trait\CacheItem;

use Cl\Cache\Exception\InvalidArgumentException;

trait CacheItemExpirationTrait
{
    const DEFAULT_EXPIRE_AFTER = 43200; //seconds

    /**
     * Set the expiration time for the cache item.
     *
     * @param \DateTimeInterface|int|null $expiration The expiration time.
     *
     * @return static
     * @throws InvalidArgumentException If the expiration is of an invalid type.
     */
    public function expiresAt(?\DateTimeInterface $expiration = null): static
    {
        
        return $this->setExpiration(
            $expiration instanceof \DateTimeInterface  
                ? $expiration
                : $this->createExpiration($expiration)
        );
    }

    /**
     * Set the expiration time for the cache item based on an interval from the current time.
     *
     * @param \DateInterval|int|null $expiration The expiration interval or timestamp.
     *
     * @return static
     * @throws InvalidArgumentException If the expiration is of an invalid type.
     */
    public function expiresAfter(\DateInterval|int|null $expiration): static
    {
        return $this->expiresAt($this->createExpiration($expiration));
    }

    /**
     * Check if the cache item is expired.
     *
     * @return bool
     */
    private function isExpired()
    {
        return $this->getExpiration()->getTimestamp() <= time();
    }

    /**
     * Create an expiration date based on the provided interval or timestamp.
     *
     * @param \DateInterval|int|null $expiration The expiration interval or timestamp.
     *
     * @return \DateTimeImmutable
     * @throws InvalidArgumentException If the expiration is of an invalid type.
     */
    protected function createExpiration(int|\DateInterval $expiration = null)
    {
        return (new \DateTimeImmutable('now'))->add(
            match (true) {
                $expiration instanceof \DateInterval => $expiration,
                (is_int($expiration) && $expiration > 0)
                || is_null($expiration) => new \DateInterval(sprintf('PT%dS', $expiration ?? static::DEFAULT_EXPIRE_AFTER)),
                default => throw new InvalidArgumentException("Expiration argument must be an instance of the \DateTimeInterface or \DateInterval or an signed integer"),
            }
        );    
    }
}