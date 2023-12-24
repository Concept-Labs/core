<?php
namespace Cl\Cache\Trait\CacheItem;

use Cl\Cache\Trait\CacheKeyNormalizerTrait;

trait CacheItemPropertyAccessTrait
{
    use CacheKeyNormalizerTrait;

    protected string $key;
    protected mixed $value;
    protected bool $hit;
    protected ?\DateTimeInterface $expiration;
    protected mixed $extra;

    public function getKey(): string
    {
        return $this->key;
    }

    protected function setKey(string|\Stringable $key) : static
    {
        $this->key = $this->normalizeKey($key);
        return $this;
    }

    protected function getValue(): mixed
    {
        return $this->value;
    }

    protected function setValue(mixed $value): static
    {
        $this->value = $value;
        $this->setHit(true);
        return $this;
    }

    public function getHit(): bool
    {
        return $this->hit;
    }

    public function setHit(bool $hit): static
    {
        $this->hit = $hit;
        return $this;
    }

    public function getExpiration(): ?\DateTimeInterface
    {
        return $this->expiration;
    }

    public function setExpiration(\DateTimeInterface $expiration) : static
    {
        $this->expiration = $expiration;
        return $this;
    }

    public function getExtra() : mixed
    {
        return $this->extra;
    }
    
    public function setExtra(mixed $extra) : static
    {
        $this->extra = $extra;
        return $this;
    }
}