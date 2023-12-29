<?php
namespace Cl\Container\Repository\Service\Info;

class ServiceInfo implements ServiceInfoInterface
{
    private mixed $info;

    public function get(): mixed
    {
        return $this->info;
    }
}