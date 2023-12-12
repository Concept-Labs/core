<?php
namespace Cl\Route\Abstract;

use Cl\Debug\Debug;

use Cl\Config;
use Cl\Request\Request;

abstract class Route 
//implements Cl\Route\Interface\Route
{
    const CFG_NODE_ROUTE = 'route';
    const CFG_NODE_ROUTE_404 = '404';
    const CFG_NODE_DEFAULT = 'default';
    const CFG_NODE_TYPE = 'type';


    public function __construct(protected array $routeInfo){}
    
    public function factory(array  $routeInfo)
    {
        die('fff');
        return new self($routeInfo);
        
    }
    
    public function doRoute()
    {
        echo '<br/> do route abstract';
        Debug::dump($this->routeInfo);
    }

    protected function prepareLayout()
    {
        $baseLayout = Config::node('layout');
    }

    protected function validateRouteInfo()
    {
        // if (!isset($routeInfo[Route::CFG_NODE_TYPE])){
        //     $routeInfo[Route::CFG_NODE_TYPE]
        // }
        // if (!isset($routeInfo[Action::CFG_NODE_TYPE])){

        // }

        return true;
    }

}