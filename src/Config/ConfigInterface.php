<?php
/**
 * Config interface
 */
namespace Cl\Core\Config;

/**
 * Config interface
 */
interface ConfigInterface
{
    const CFG_NODE_COMMON = "___common";
    const CFG_NODE_DEFAULT = 'default';
    const CFG_NODE_LAYOUT = 'layout';
    const CFG_NODE_VIEW = 'view';
    const CFG_NODE_TYPE = 'type';
    const CFG_NODE_TEMPLATE = 'template';

    /**
     * Construct Config
     *
     * @param \Cl\Core\Config\Node\NodeInterface $nodeInterface Root config Node
     * 
     * @return Config
     */
    public function __construct(\Cl\Core\Config\Node\NodeInterface $nodeInterface);

    /**
     * Get config node. 
     * {$path} is string in format "node:sub-node:sub-sub-node"
     *
     * @param string|null $path path string or null for root node
     * 
     * @return \Cl\Core\Config\Node\NodeInterface
     */
    public function getNode(?string $path = null): \Cl\Core\Config\Node\NodeInterface;

    /**
     * Get node by paths using "bubbling". Means if 
     *
     * @param string $path 
     * 
     * @return \Cl\Core\Config\Node\NodeInterface
     */
   // public function getNodeBubble(string $path): \Cl\Core\Config\Node\NodeInterface;

}