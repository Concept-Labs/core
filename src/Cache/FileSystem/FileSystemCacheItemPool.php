<?php
namespace Cl\Cache\FileSystem;

use Cl\Cache\CacheItemInterface;
use Cl\Cache\CacheItemPoolAbstract;
use Cl\Cache\InMemory\FileSystemCacheItem;
use Psr\Cache\CacheItemInterface as CacheCacheItemInterface;

class FileSystemCacheItemPool extends CacheItemPoolAbstract
{
    use FileSystemCacheItemPoolConfigTrait;

    /**
     * @inheritDoc
     */
    public function save(CacheCacheItemInterface $item): bool
    {
        try {
            $key = $item->getKey();
            $value = $item->get();

            // Serialize the cache item value
            $serializedValue = serialize($value);

            // Save to the filesystem (assuming a directory structure)
            $filePath = $this->getCacheFilePath($key);
            file_put_contents($filePath, $serializedValue);

            return true;
        } catch (\Throwable $e) {
            // Handle exceptions, log, or rethrow as needed
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function hasItem(string|\Stringable|callable $key): bool
    {
        try {
            $filePath = $this->getCacheFilePath($key);
            return file_exists($filePath);
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function getItem(string|\Stringable|callable $key): CacheItemInterface
    {
        try {
            $filePath = $this->getCacheFilePath($key);

            if (file_exists($filePath)) {
                $serializedValue = file_get_contents($filePath);
                $value = unserialize($serializedValue);

                $cacheItem = new FileSystemCacheItem($key, $value);

                return $cacheItem;
            }
        } catch (\Throwable $e) {
            //@TODO Handle exceptions, log, or rethrow as needed
            
        }
        // If the file doesn't exist, return a new cache item
        return new FileSystemCacheItem($key);
    }

    /**
     * @inheritDoc
     */
    public function deleteItem(string|\Stringable|callable $key): bool
    {
        try {
            $filePath = $this->getCacheFilePath($key);
            if (file_exists($filePath)) {
                return unlink($filePath);
            }

            return false;
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function clear(): bool
    {
        try {
            $cacheDirectory = $this->getBasePath();
            $files = glob($cacheDirectory . '*.cache');

            foreach ($files as $file) {
                unlink($file);
            }

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

}
