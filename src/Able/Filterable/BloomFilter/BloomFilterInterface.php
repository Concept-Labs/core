<?php
namespace Cl\Able\Filterable\BloomFilter;

interface BloomFilterInterface
{
    /**
     * Add an item to the Bloom filter.
     *
     * @param string $item The item to add.
     * 
     * @return void
     */
    public function add(string $item): void;

    /**
     * Check if an item might be in the Bloom filter.
     *
     * @param string $item The item to check.
     *
     * @return bool True if the item might be in the Bloom filter, false otherwise.
     */
    public function mightContains(string $item): bool;

    /**
     * Check if an item is definitely not in the Bloom filter.
     *
     * @param string $item The item to check.
     *
     * @return bool True if the item is definitely not in the Bloom filter, false otherwise.
     */
    public function notContains(string $item): bool;

    /**
     * Generate hash values for an item.
     *
     * @param string $item The item to hash.
     *
     * @return array An array of hash values.
     */
    public function bloomHash(string $item): array;
}