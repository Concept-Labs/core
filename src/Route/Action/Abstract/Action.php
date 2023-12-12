<?php
namespace Cl\Route\Action\Abstract;

use Cl\Debug\Debug;

class Action{

    const CFG_NODE_ACTION = 'action';
    const CFG_NODE_TYPE = 'type';
    const CFG_NODE_ACTION_INDEX = 'action_index';
    const ACTION_DEFAULT_TYPE = 'Index';
    
    
    public function __construct()
    {
        Debug::dump($this);
    }
}