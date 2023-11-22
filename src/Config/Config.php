<?php
namespace Cl\Core\Config;

class Config 
    implements 
    \Cl\Core\Config\ConfigInterface, 
    \Cl\Core\Factory\FactorableInterface,
    \Cl\Core\Di\Iface\InjectableInterface
{
    protected $rootNode;

    public function __construct(\Cl\Core\Config\Node\NodeInterface $node)
    {
        $this->rootNode = $node;
    }
    public static function factory(...$args)
    {
        return new static(...$args);
    }
    public function getNode(?string $path = null): \Cl\Core\Config\Node\NodeInterface
    {
        //@TODO
        return $this->rootNode;
    }
}