<?php
use Cl\Cache\InMemory\InMemoryCacheItem;
use PHPUnit\Framework\TestCase;
use Cl\Cache\CacheItemInterface;

class InMemoryCacheItemTest extends TestCase
{
    
    /**
     * Test instance
     *
     * @return void
     */
    public function testCacheItemInterface()
    {
        // Arrange
        $key = 'test_key';
        $value = 'test_value';
        $expiration = new \DateTime('+1 hour');
        $extra = [
            'ext_test_object' => new stdClass(),
            'ext_test_array' => [1,2,3],
            'ext_test_value' => 'test value',
        ];

        $cacheItem = new InMemoryCacheItem($key, $value, $expiration, $extra);

        // Act & Assert
        $this->assertInstanceOf(CacheItemInterface::class, $cacheItem);
        $this->assertInstanceOf(\Psr\Cache\CacheItemInterface::class, $cacheItem);

    }

    /**
     * Test instance methods
     *
     * @return void
     */
    public function testCacheItemMethods()
    {
        // Arrange
        $key = 'test_key';
        $value = 'test_value';
        $expiration = new \DateTime('+1 hour');
        $extra = [
            'ext_test_object' => new stdClass(),
            'ext_test_array' => [1,2,3],
            'ext_test_value' => 'test value',
        ];

        $cacheItem = new InMemoryCacheItem($key, $value, $expiration, $extra); 
        // Act & Assert
        $this->assertEquals($key, $cacheItem->getKey());
        $this->assertEquals($value, $cacheItem->get());
        $this->assertTrue($cacheItem->isHit());
        $this->assertEquals($extra, $cacheItem->getExtra());

        // Set new value and check
        $newValue = 'new_value';
        $cacheItem->set($newValue);
        $this->assertEquals($newValue, $cacheItem->get());

        // Check expiresAt()
        $newExpiration = new \DateTime('+2 hours');
        $cacheItem->expiresAt($newExpiration);
        $this->assertEquals($newExpiration, $cacheItem->getExpiration());

        // Check expiresAfter()
        $cacheItem->expiresAfter(7200); // 2 hour
        $this->assertGreaterThanOrEqual($newExpiration, $cacheItem->getExpiration());
    }

    public function testExceptionOnInvalidKey()
    {
        $this->expectException(Cl\Cache\Exception\InvalidArgumentException::class);
        new InMemoryCacheItem(['invalid_key'], 'value');
    }

    public function testExceptionOnInvalidValue()
    {
        $this->expectException(Cl\Cache\Exception\InvalidArgumentException::class);
        new InMemoryCacheItem('key', fopen('php://temp', 'r')); // Invalid value, should throw an exception
    }

    public function testExceptionOnInvalidExpiration()
    {
        $this->expectException(Cl\Cache\Exception\InvalidArgumentException::class);
        $cacheItem = new InMemoryCacheItem('key', 'value');
        $cacheItem->expiresAt('invalid_expiration'); // Invalid expiration, should throw an exception
    }
}