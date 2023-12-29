<?php

namespace Cl\Container\Repository;


use Traversable;

class ServiceRepositoryAggregate implements ServiceRepositoryAggregateInterface
{
    /**
     * Service repositories
     *
     * @var array<string,ServiceRepositoryInterface>
     */
    private array $repositories;

    public function getRepositories()
    {
        return $this->repositories;
    }

    public function addRepository(ServiceRepositoryInterface $serviceRepository): static
    {
        $this->repositories[get_class($serviceRepository)][] = $serviceRepository;

        return $this;
    }

	function getIterator(): Traversable|array
    {
        foreach ($this->getRepositories() as $serviceRepository) {
            yield $serviceRepository;
        }
    }
}