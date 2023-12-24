<?php
namespace Cl\Coroutine;
use Cl\Job as Job;
use Cl\Coroutine\Scheduler as Scheduler;

class SystemCall
{
    protected $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function __invoke(Job $job, Scheduler $scheduler)
    {
        $callback = $this->callback;
        return $callback($job, $scheduler);
    }
}