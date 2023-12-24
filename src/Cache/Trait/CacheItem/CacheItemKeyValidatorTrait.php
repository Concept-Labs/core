<?php
namespace Cl\Cache\Trait\CacheItem;

use Cl\Cache\Exception\InvalidArgumentException;

trait CacheItemKeyValidatorTrait
{
    const PSR6_RESERVED = "{}()/\@:";

    /**
     * Determines if the specified key is legal under PSR-6.
     *
     * @param string $key The key to validate.
     * 
     * @throws InvalidArgumentException
     *   An exception implementing The Cache InvalidArgumentException interface
     *   will be thrown if the key does not validate.
     * @return static
     */
    protected function validateKey(string|\Stringable $key): static
    {
        $key = (string)$key;
        match (true) {
            !is_string($key) || $key === '' => throw new InvalidArgumentException('Key should be a non empty string'),
            (0 > preg_match('#[' . preg_quote(static::PSR6_RESERVED) . ']#', $key))
                => throw new InvalidArgumentException(sprintf('Can\'t validate the specified key: %s', $key)),
            default => true
        };
        return $this;
    }
}