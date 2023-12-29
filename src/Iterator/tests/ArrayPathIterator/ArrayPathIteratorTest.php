<?php
use PHPUnit\Framework\TestCase;
use Cl\Iterator\ArrayPathIterator\ArrayPathIterator;
use Cl\Iterator\ArrayPathIterator\ArrayPathIteratorInterface;
use Cl\Iterator\ArrayPathIterator\Exception\InvalidPathException;

/**
 * @covers Cl\Iterator\ArrayPathIterator\ArrayPathIterator
 */
class ArrayPathIteratorTest extends TestCase
{
    protected ArrayPathIterator $arrayPathIterator;
    public function arrayPathIteratorDataProvider()
    {
        
    }

    
    public function setUp():void
    {
        $data = [
            'a' => ['b' => 'value'],
            'a.a' => ['b' => ["c.c" => 'value']],
            'childInstance' => ['a','b'],
            
        ];
        $this->arrayPathIterator =  new ArrayPathIterator($data);
    }
    /**
     * Test the getter
     *
     * @return void
     */
    #[DataProvider('arrayPathIteratorDataProvider')]
    public function testOffsetGetByKey()
    {
        $result = $this->arrayPathIterator->offsetGet('a');
        $this->assertSame(['b' => 'value'], $result->getArrayCopy());

        $result = $this->arrayPathIterator['a'];
        $this->assertSame(['b' => 'value'], $result->getArrayCopy());
    }

    /**
     * Test the getter using path string
     *
     * @return void
     */
    public function testOffsetGetByPath()
    {
        $result = $this->arrayPathIterator->offsetGet('a.b');
        $this->assertSame('value', $result);

        $result = $this->arrayPathIterator['a.b'];
        $this->assertSame('value', $result);
        
        $result = $this->arrayPathIterator->offsetGet('a');
        $this->assertInstanceOf(ArrayPathIteratorInterface::class, $result);
    }

    /**
     * Test the getter using path string
     *
     * @return void
     */
    public function testOffsetGetByPathReturnInstance()
    {
        $result = $this->arrayPathIterator->offsetGet('"a.a"');
        $this->assertInstanceOf(ArrayPathIteratorInterface::class, $result);
    }

    /**
     * Test the getter using path string
     *
     * @return void
     */
    public function testOffsetGetByPathSplitter()
    {
        $result = $this->arrayPathIterator->offsetGet('"a.a".b');
        $this->assertInstanceOf(ArrayPathIteratorInterface::class, $result);
        $this->assertSame(['c.c'=>'value'], (array)$result);
    }

    /**
     * Test the getter with invalid path string
     *
     * @return void
     */
    public function testOffsetGetInvalidPath()
    {
        $this->expectException(InvalidPathException::class);

        $this->arrayPathIterator->offsetGet('invalid.path');
    }

    /**
     * Test child instance
     *
     * @return void
     */
    public function testNewChildInstance()
    {
        $data = ['a' => ['b' => ['c','d'=>'e']]];
        $iterator = new ArrayPathIterator($data);
        /** @var ArrayPathIterator $child */
        $child = $iterator['a.b'];

        $this->assertInstanceOf(ArrayPathIterator::class, $child);
        $this->assertSame(['c','d'=>'e'], $child->getArrayCopy());
        $this->assertSame('a.b', $child->getPath());
        $this->assertSame($iterator, $child->getParent());
        $this->assertSame(ArrayPathIterator::PATH_DEFAULT_SEPARATOR, $child->getSeparator());
        $this->assertSame(0, $child->getFlags());
    }
}