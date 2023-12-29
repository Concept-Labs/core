<?php
namespace Cl\Container\Repository\Service;

use Cl\Container\Repository\Service\Info\ServiceInfo;
use Cl\Container\Repository\Service\Parameter\ServiceParameterInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class Service implements ServiceInterface
{
    const SINGLETON = 1;
    const FACTORY =  2;
    const PROTOTYPE = 3;

    private string $_name;
    private string $_nameSpace;

    private object $_instance;

    /**
     * Service constructor parameters
     * 
     * @template TParameters array<string,Parameter>
     * 
     * @var TParameters 
     */
    private array $_parameters;

    private $_callback;
    private Context $_context;
    private ServiceInfo $_info;
    

    public function getInstance(): object
    {
        return $this->serviceInstance;
    }

    public function resolve()
    {

    }

    public function withCallback(callable $callback): static
    {
        $this->_callback = $callback;
        return $this;
    }

    public function withParameter(ServiceParameterInterface $parameter): static
    {
        ParameterBag
        $this->parameters[$parameter->getName()] = $parameter;
        return $this;
    }

    public function set(mixed $service): static
    {
        if (is_callable())
        return $this;
    } 

    public function getInfo(): ServiceInfoInterface;
    {
        return $this->_info;
    }
}