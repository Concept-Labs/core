<?php
namespace Cl\Container\Repository;

use Cl\Container\Repository\Service\Info\ServiceInfoInterface;

interface ServiceRepositoryInterface
{
  
    function addService(string $id, mixed $service, ?ServiceInfoInterface $info = null): mixed;
    function getService(string $id): mixed;
    function removeService(string $id): static;
    function hasService(string $id): bool;
}