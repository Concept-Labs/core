<?php
namespace Cl\Container\Repository;

use Cl\Container\Repository\Service\ServiceInterface;

class InstanceRepository implements ServiceRepositoryInterface
{

    /**
     * Services container
     *
     * @var array<ServiceInterface>
     */
    private array $services;


    public function getService(string $id): ServiceInterface
    {
        if (!$this->hasService($id)) {
            throw new NotFoundException(sprintf('Service "%s" not found'));
        }

    }

    public function getIterator()
}