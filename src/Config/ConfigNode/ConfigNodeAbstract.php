<?php
namespace Cl\Config\ConfigNode;
use Cl\Config\ConfigNode\ConfigNodeTrait;

class ConfigNodeAbstract implements ConfigNodeInterface
{
    use ConfigNodeTrait;

    /**
     * Constructor
     *
     * @param array $nodeData 
     */
    public function __construct(private array $nodeData)
    {
        (fn($nodeData) => $this($nodeData))($nodeData);
    }
    
}