<?php
namespace Cl\Able\Filterable\BloomFilter;

use Cl\Able\Filterable\BloomFilter\Exception\ErrorInHashMethodException;

/**
 * Class BloomFilter
 *
 * A simple Bloom filter implementation.
 */
class BloomFilter implements BloomFilterInterface
{
    use BloomFilterTrait;
    /**
     * BloomFilter constructor.
     *
     * @param int      $size          The size of the Bloom filter.
     * @param int      $hashFunctions The number of hash functions to use.
     * @param callable $hashMethod    The callable hash method
     */
    public function __construct(int $size, int $hashFunctions, callable $hashMethod = 'crc32')
    {
        $this->bloomInit($size, $hashFunctions, $hashMethod);
    }
}