<?php
namespace Cl\Core\Di;

class RepositoryManager implements Iface\RepositoryManagerInterface
{
    /**
     * Singleton repository
     *
     * @var SplObjectStorage
     */
    protected $singletonRepository;
    protected $sessionRepository;

}