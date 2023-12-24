<?php
namespace Cl\Coroutine;

use Cl\Coroutine\Job as Job;
use Cl\Coroutine\SystemCall as SystemCall;

class Scheduler
{
    protected $maxJobId;
    protected $jobMap = [];
    protected $jobQueue;

    public function __construct()
    {
        $this->jobQueue = new \SplPriorityQueue();
        //SplPriorityQueue()
    }

    public function newJob(\Generator $coroutine, $priority = 1)
    {
        $jid = ++$this->maxJobId;
        $job = new Job($jid, $coroutine, $priority);
        $this->jobMap[$jid] = $job;
        $this->schedule($job);
        return $jid;
    }

    public function schedule(Job $job): void
    {
        $this->jobQueue->insert($job, $job->getPriority());
    }

    public function run(): void
    {
        while (!$this->jobQueue->isEmpty()) {
            $job = $this->jobQueue->extract();//dequeue();
            $jobResponse = $job->run();

            if ($jobResponse instanceof SystemCall) {
                $jobResponse($job, $this);
            }

            if ($job->isFinished()) {
                unset($this->jobMap[$job->getJobId()]);
            } else {
                $this->schedule($job);
            }
        }
    }

}