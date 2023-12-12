<?php
namespace Cl\;

use Cl\Request\Request;
use Cl\Route\Route;

use Cl\Debug\Debug;


class App
{
    protected static $request;
    protected static $routeInfo;
    protected static $route;

    public function __construct(Request $request)
    {
        static::$request = $request;
    }

    public static function factory(Request $request): self
    {
        return new self($request);
    }

    

    public function exec()
    {
        $this->prepareRoute();
    }

    /**
     *
     * @return \Cl\Route\Abstract\Route
     */
    public function prepareRoute()
    {
        $this->routeInfo = static::$request->getRouteInfo();
        $this->route = Factory::singleton(
            $this->routeInfo[Route::CFG_NODE_TYPE], 
            $this->routeInfo
        );
    }

    public static function getRequest()
    {
        return static::$request;
    }
    
}