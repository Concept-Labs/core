<?php
namespace Cl\Container;

use Cl\Container\Service\ServiceRepositoryAggregateInterface;
use Cl\Container\Service\Repository\ServiceRepositoryInterface;
use Cl\Container\Exception\NotFoundException;

class Container implements ContainerInterface
{

    /**
     * Constructor
     *
     * @param ServiceRepositoryAggregateInterface $ServiceRepositoryAggregate
     */
    public function __construct(private readonly ServiceRepositoryAggregateInterface $ServiceRepositoryAggregate)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $id) : mixed
    {
        if (!$this->has($id)) {
            throw new NotFoundException(sprintf('Service with id "%s" not found'));
        }
        
            /** @var ServiceRepositoryInterface  $serviceRepository */
            foreach ($this->ServiceRepositoryAggregate as $serviceRepository) {
                if ($serviceRepository->has($id)) {
                    $service = $serviceRepository->get($id);
                    break;
                }
            }
        
        throw new NotFoundException(sprintf('Service with id "%s" not found'));
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $id): bool
    {
        /** @var ServiceRepositoryInterface  $serviceRepository */
        foreach ($this->ServiceRepositoryAggregate as $serviceRepository) {
            if ($serviceRepository->hasSerice($id)) {
                return true;
            }
        }
        return false;
    }
}