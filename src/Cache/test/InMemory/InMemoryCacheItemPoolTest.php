<?php
use Cl\Cache\InMemory\InMemoryCacheItem;
use PHPUnit\Framework\TestCase;
use Cl\Cache\CacheItemPoolInterface;
use Cl\Cache\InMemory\InMemoryCacheItemPool;
use Cl\Cache\CacheItemInterface;

class InMemoryCacheItemPoolTest extends TestCase
{
    protected CacheItemPoolInterface $cache;

    protected function setUp(): void
    {
        $this->cache = new InMemoryCacheItemPool();
    }

    public function testCacheItemPoolInterface()
    {
        // Arrange
        $cacheItemPool = new InMemoryCacheItemPool(); 

        // Act & Assert
        $this->assertInstanceOf(CacheItemPoolInterface::class, $cacheItemPool);
        $this->assertInstanceOf(\Psr\Cache\CacheItemPoolInterface::class, $cacheItemPool);
    }

    public function testCacheItemInterface()
    {
        // Arrange
        $key = 'test_key';
        $value = 'test_value';
        $expiration = new \DateTime('+1 hour');
        $ext = [
            'ext_test_object' => new stdClass(),
            'ext_test_array' => [1,2,3],
            'ext_test_value' => 'test value',
        ];

        $cacheItem = new InMemoryCacheItem($key, $value, $expiration);

        // Act & Assert
        $this->assertInstanceOf(CacheItemInterface::class, $cacheItem);
        $this->assertInstanceOf(\Psr\Cache\CacheItemInterface::class, $cacheItem);

        // Додайте тести для інших методів CacheItemInterface
    }

    public function testGetItem()
    {
        $key = 'test_key';
        $item = $this->cache->getItem($key);

        $this->assertInstanceOf(CacheItemInterface::class, $item);
        $this->assertEquals($key, $item->getKey());
        // Додайте інші тести за необхідністю
    }

    public function testGetItems()
    {
        $keys = ['key1', 'key2'];
        $items = $this->cache->getItems($keys);

        foreach ($items as $item) {
            $this->assertInstanceOf(CacheItemInterface::class, $item);
            $this->assertTrue(in_array($item->getKey(), $keys));
        }
        // Додайте інші тести за необхідністю
    }

    // Додайте тести для інших методів та обробки виключень
}