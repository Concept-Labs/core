<?php
namespace Cl\Iterator\ArrayPathIterator;

class ArrayPathIterator extends \ArrayIterator implements ArrayPathIteratorInterface
{
    use ArrayPathIteratorPropertyTrait;
    use ArrayPathIteratorSplitterTrait;
    use ArrayPathIteratorTrait;
    
    /**
     * Default path separator.
     */
    const PATH_DEFAULT_SEPARATOR = ".";

    /**
     * ArrayPathIterator constructor.
     *
     * @param array $data  
     * @param int   $flags 
     */
    public function __construct(array $data, int $flags = 0)
    {
        parent::__construct($data, $flags);
    }

    /**
     * Create the children instance
     *
     * @param array  $data 
     * @param string $path The path  
     * 
     * @return ArrayPathIteratorInterface
     */
    public function getChild(array $data, string $path): ArrayPathIteratorInterface
    {
        $childInstance = new static($data, $this->getFlags());
        $childInstance
            ->setPath($path)
            ->setParent($this)
            ->setSeparator($this->getSeparator());

        return $childInstance;
    }

    /**
     * Set the internal array for the current instance.
     *
     * @param array $array 
     * 
     * @return void
     */
    private function _setStorageArray(array $array) : void
    {
        // Update the internal storage
        // \ArrayIterator::__construct()
        parent::__construct($array, $this->getFlags());
    }
}