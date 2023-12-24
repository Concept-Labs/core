<?php

namespace Cl\Config\DataProvider;

/**
 * Interface for configuration providers.
 */
interface ConfigDataProviderInterface
{
    /**
     * Load configuration 
     *
     * @return array 
     */
    public function load(): array;

    /**
     * Save Configuration
     *
     * @param array $data 
     * 
     * @return boolean
     */
    public function save(array $data): bool;
}