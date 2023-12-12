<?php
namespace Cl\Di;

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