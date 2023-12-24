<?php

namespace Cl\Able\Iteratorable\ArrayPathIterator;

trait ArrayPathIteratorPropertyTrait
{

    protected string $path = '';
    protected ArrayPathIteratorInterface|null $parentInstance = null;
    protected string $separator = ArrayPathIteratorInterface::PATH_DEFAULT_SEPARATOR;
    protected int $flags = 0;

    /**
     * Get the path for the current instance.
     *
     * @return string
     */
    public function getPath(): string
    {
        //@TODO do not add dot at beginnig of children paths
        return ltrim($this->path, '.');
    }
    
    /**
     * Set the path for the current instance.
     * 
     * @param string $path The path
     *
     * @return ArrayPathIteratorInterface
     */
    public function setPath(string $path): ArrayPathIteratorInterface
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Get the parent instance.
     *
     * @return ArrayPathIteratorInterface|null
     */
    public function getParent(): ArrayPathIteratorInterface|null
    {
        return $this->parentInstance;
    }
    
    /**
     * Set the parent instance.
     * 
     * @param $parentInstance The parent instance
     *
     * @return ArrayPathIteratorInterface|null
     */
    public function setParent(ArrayPathIteratorInterface &$parentInstance): ArrayPathIteratorInterface|null
    {
        $this->parentInstance = $parentInstance;

        return $this;
    }

    /**
     * Get the path separator.
     *
     * @return string
     */
    public function getSeparator(): string
    {
        return $this->separator;
    }
    
    /**
     * Set the path separator.
     *
     * @param string $separator The separator
     * 
     * @return string
     */
    public function setSeparator(string $separator): string
    {
        return $this->separator = $separator;
    }

    /**
     * {@inheritDoc}
     */
    public function getFlags(): int
    {
        return parent::getFlags();
    }


}