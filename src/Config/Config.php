<?php

namespace Cl\Config;

use Cl\Callable\Stringable\StringExtractorTrait;
use Cl\Config\Exception\UnableToUsePathOnDataException;
use Cl\Config\DataProvider\ConfigDataProviderInterface;

/**
 * Class for configuration management.
 */
class Config extends \ArrayIterator //implements ConfigInterface
{
    use StringExtractorTrait;
    
    const ARRAY_ITERATOR_FLAGS = 0;
    protected array $configDataProviders;

    /**
     * Constructor
     * 
     * Config data may be array or \ArrayAccess + \Traversable for the tree access
     * or final value used for get()
     * 
     * @param mixed|null                         $configData          Configuration data. 
     * @param ConfigDataProviderInterface[]|null $configDataProviders Data providers
     */
    public function __construct(
        mixed $configData,
        array $configDataProviders = [],
        protected string $path = '',
        protected Config|null $parent = null
    ) {
        //init properties
        array_reduce(
            $configDataProviders, 
            fn(ConfigDataProviderInterface $configDataProvider) => $this->addProvider($configDataProvider)
        );
        
        if ()
        parent::__construct($configData, static::ARRAY_ITERATOR_FLAGS);
    }

    public function hasParent(): bool
    {
        return is_null($this->parent) ? false : true;
    }

    public function getParent(): static|null
    {
        return $this->parent;
    }

    public function isFinal()
    {
        //return 
    }
    
    public function addProvider(ConfigDataProviderInterface $configDataProvider): static
    {
        $this->configDataProviders[] = $configDataProvider;

        return $this;
    }

    protected function getProviders(): array
    {
        return $this->configDataProviders;
    }

    
    protected function getData()
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $path = null, mixed $default = null)
    {
        if (is_null($path)) {
            return $this->getData();
        }
        if (key_exists(((array)$this)[$path]))
        $config = $this->getByPath($path);
        
        return $node->get($default);
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $path, mixed $value): static
    {
        $node = $this->getConfigNode()->get($path);
        if (!$node instanceof ConfigNodeInterface) {
            throw new ConfigNodeNotFoundException(sprintf('Config node with path "%s" not found', $path));
        }

        $node->set($value);//!!!!!!!!!!!!!!!!

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $path): bool
    {
        return $this->getByPath($path, true);
    }

    /**
     * {@inheritDoc}
     */
    public function remove(?string $path = null): static
    {
        $this->getByPath($path)->remove();
        

    }

    /**
     * Get all configuration values.
     *
     * @return array All configuration values.
     */
    public function all(): mixed
    {
        return $this->getData()->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getByPath(\Stringable|string|callable $path, bool $checkExistsOnly = false) : mixed
    {
        $configData = $this->getData();

        if (is_null($configData) 
            || !is_array($configData) 
            || !($configData instanceof \ArrayAccess && $configData instanceof \Traversable)
        ) {
            throw new UnableToUsePathOnDataException("Can't retrieve the node by path because data is not array or does not implements \ArryAccess  interface");
        }
        
        $path = static::bindAndExtractString($path, $this);
        

        return $checkExistsOnly 
            ?? (is_array($dataReference) || $dataReference instanceof \ArrayAccess)
                ? new static($dataReference, [], $path)
                : $dataReference;
    }
    // /**
    //  * {@inheritDoc}
    //  */
    // public function getNodeByPath(\Stringable|string|callable $path, bool $checkExistsOnly = false): ConfigNode|bool
    // {
    //     $configNodeData = $this->getConfigNode()->get();
    //     if (!is_array($configNodeData) || !$configNodeData instanceof \ArrayAccess) {
    //         throw new UnableToUsePathOnDataException("Can't retrieve the node by path because data is not array or does not implements \ArryAccess  interface");
    //     }
        
    //     $path = static::bindAndExtractString($path, $this);
    //     $pathParts = explode('.', $path);
    //     $dataReference = &((array)$this?->$configNodeData);

    //     foreach ($pathParts as $key) {
    //         if (!key_exists($key, $dataReference)) {
    //             return false;
    //         }

    //         $dataReference = &$dataReference[$key];
    //     }

    //     return $checkExistsOnly ?? new ConfigNode($dataReference, $path);
    // }
}