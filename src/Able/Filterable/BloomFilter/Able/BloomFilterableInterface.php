<?php
namespace Cl\Able\Filterable\BloomFilter\Able;

interface BloomFilterableInterface 
{

    /**
     * BloomFilter initialization.
     *
     * @param int      $size          The size of the Bloom filter.
     * @param int      $hashFunctions The number of hash functions to use.
     * @param callable $hashMethod    The callable hash method
     * 
     * @return BloomFilterableInterface
     */
    public function bloomInit(int $size, int $hashFunctions, callable $hashMethod = 'crc32'): BloomFilterableInterface;

    /**
     * Add an item to the Bloom filter.
     *
     * @param string $item The item to add.
     * 
     * @return void
     */
    public function bloomAdd(string $item): void;

    /**
     * Check if an item might be in the Bloom filter.
     *
     * @param string $item The item to check.
     *
     * @return bool True if the item might be in the Bloom filter, false otherwise.
     */
    public function bloomMightContain(string $item): bool;

    /**
     * Check if an item is definitely not in the Bloom filter.
     *
     * @param string $item The item to check.
     *
     * @return bool True if the item is definitely not in the Bloom filter, false otherwise.
     */
    public function bloomNotContain(string $item): bool;

    /**
     * Generate hash values for an item.
     *
     * @param string $item The item to hash.
     *
     * @return array An array of hash values.
     */
    public function bloomHash(string $item): array;
}