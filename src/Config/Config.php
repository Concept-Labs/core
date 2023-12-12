<?php
namespace Cl\Config;

use \Cl\Config\Node\NodeInterface;
use \Cl\Di\Iface\InjectableInterface;

class Config 
    implements 
    ConfigInterface, 
    \Cl\Factory\FactorableInterface,
    InjectableInterface
    
{
    use \Cl\Di\AwareInjectableTrait;
    protected $rootNode;

    public function __construct(NodeInterface $node)
    {
        $this->rootNode = $node;
    }
    public static function factory(...$args)
    {
        return new static(...$args);
    }
    public function getNode(?string $path = null): NodeInterface
    {
        //@TODO
        if ($path === null) {
            return $this->rootNode;
        }
    }
}