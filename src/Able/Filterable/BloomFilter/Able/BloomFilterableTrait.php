<?php
namespace Cl\Able\Filterable\BloomFilter\Able;

use Cl\Able\Filterable\BloomFilter\Exception\ErrorInHashMethodException;

/**
 * Trait BloomFilter
 *
 * A simple Bloom filter implementation @see BloomFilterableInterface.
 */
trait BloomFilterableTrait
{
    /**
     * @var array The Bloom filter array.
     */
    protected array $bloom_filter;

    /**
     * @var int The size of the Bloom filter.
     */
    protected int $bloom_size;

    /**
     * @var int The number of hash functions to use.
     */
    protected int $bloom_hashFunctions;

    /**
     * @var callable The callable hash method to use.
     */
    protected mixed $bloom_hashMethod;

    /**
     * {@inheritDoc}
     */
    public function bloomInit(int $size, int $hashFunctions, callable $hashMethod = 'crc32'): void
    {
        $this->bloom_filter = array_fill(0, $size, 0);
        $this->bloom_size = $size + ($size % 2); //use multiple of 2
        $this->bloom_hashFunctions = $hashFunctions;
        $this->bloom_hashMethod = $hashMethod;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function bloomAdd(string $item): void
    {
        $hashes = $this->bloomHash($item);

        foreach ($hashes as $hash) {
            $this->bloom_filter[$hash] = 1;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function bloomMightContains(string $item): bool
    {
        $hashes = $this->bloomHash($item);

        foreach ($hashes as $hash) {
            if ($this->bloom_filter[$hash] !== 1) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function bloomNotContains(string $item): bool
    {
        $hashes = $this->bloomHash($item);

        foreach ($hashes as $hash) {
            if ($this->bloom_filter[$hash] !== 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function bloomHash(string $item): array
    {
        $hashes = [];
        for ($i = 0; $i < $this->bloom_hashFunctions; $i++) {
            $hashes[] = $this->bloomHashFunction($item . $i);
        }

        return $hashes;
    }

    /**
     * Invoke the hash function
     *
     * @param string $item 
     * 
     * @return int
     */
    protected function bloomHashFunction(string $item): int
    {
        try {

            $hash = $this->bloom_hashMethod($item);

        } catch (\Throwable $e) {
            $hashMethod = match (true) {
                is_string($this->bloom_hashMethod) => sprintf('%s()', $this->bloom_hashMethod),
                is_array($this->bloom_hashMethod) => sprintf('%s::%s()', $this->bloom_hashMethod[0], $this->bloom_hashMethod[1]),
                default => "Unknown",
            };

            throw new ErrorInHashMethodException(sprintf('Error during hash method call "%s" : %s', $hashMethod, $e->getMessage()), $e->getCode(), $e->getPrevious());
        }

        $hash = match (true) {
            is_int($hash) || ctype_digit($hash) => (int)$hash,
            ctype_xdigit($hash) => hexdec($hash),
            default => throw new ErrorInHashMethodException("Hash method must return integer or hexademical"),
        };
        return $hash % $this->bloom_size;
    }
}