<?php
namespace Cl\Container\Repository;

use Cl\Container\Repository\Service\ServiceInterface;

abstract class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * Services container
     *
     * @var array<string,ServiceInterface>
     */
    private array $services;

    public function addService(object $object)
    {
        $service = new ($object, $info)
    }

    public function getService(string $id): ServiceInterface
    {
        if (!$this->hasService($id)) {
            throw new NotFoundException(sprintf('Service "%s" not found'));
        }

    }

    public function getIterator()
}