<?php
namespace Cl\Request;

use Cl\Debug\Debug;

use Cl\Config;
use Cl\Route\Abstract\Route;
use Cl\Route\Action\Abstract\Action;

class Request{
    
    /**
     * \\from globals
     * @var array
     */
    protected  $request;
    protected  $get;
    protected  $post;
    protected  $files;
    protected  $env;
    protected  $server;
    /**
     * //from globals
     */

    /**
     * Factory
     *
     * @param mixed ...$args
     * @return void
     */
    public static function factory(): self
    {
        $request = new self();

        $request->server = $_SERVER;
        $request->request = $_REQUEST;
        $request->get = $_GET;
        $request->post = $_POST;
        $request->files = $_FILES;
        $request->env = $_ENV;
        
        return $request;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public static function secure(mixed $value)
    {
        //TODO: secure
        return $value;
    }
    /**
     * \\require
     * @param string $type
     * @param string|null $key
     * @return mixed
     */
    public function require(string $type, string $key = null): mixed
    {
        return static::secure($key ? (isset($this->$type[$key])? $this->$type[$key] :null) : $this->$type);
    }

    public function request(string $key = null)
    {
        return $this->require('request', $key);
    }

    public function get(string $key = null)
    {
        return $this->require('get', $key);
    }

    public function post(string $key = null)
    {
        return $this->require('post', $key);
    }
    public function server(string $key = null)
    {
        return $this->require('server', $key);
    }
    /**
     * //require
     */    

    

    /**
     * @return array
     */
    public function getRouteInfo()
    {
//$this->server['REQUEST_URI'] = '/loen';

        $uriExploded = explode('/', $this->server('REQUEST_URI'));

        $requestRoute = (isset($uriExploded[1]) && $uriExploded[1])
            ? $uriExploded[1] 
            : Route::CFG_NODE_ROUTE_404;
        $routeNode = Config::node(Route::CFG_NODE_ROUTE, $requestRoute);
        if (!$routeNode || !is_array($routeNode)) {
            $routeNode = Config::node(
                Route::CFG_NODE_ROUTE,
                Route::CFG_NODE_ROUTE_404
            );
            $routeNode['___requestRoute'] = $requestRoute;
            $requestRoute = Route::CFG_NODE_ROUTE_404;
        } 

        $requestAction = (isset($uriExploded[2]) && $uriExploded[2]) ? $uriExploded[2] : null;
        $requestAction = $requestAction 
            ?: Config::node(
                Route::CFG_NODE_ROUTE,
                $requestRoute,
                Action::CFG_NODE_ACTION_INDEX
            );
        $actionNode = Config::node(Route::CFG_NODE_ROUTE, $requestRoute, Action::CFG_NODE_ACTION, $requestAction);
        
        Debug::dump($requestRoute);
        Debug::dump($requestAction);
        //Debug::dump($routeNode);
        Debug::dump($actionNode);
        die();
        
        return $this->validateRouteInfo($routeInfo );
    }

    
}