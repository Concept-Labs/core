<?php

namespace CL\Coroutine;

class Job
{
    protected $jobId;
    protected $priority;
    protected $coroutine;
    protected $sendValue;
    protected $initialInteration = true;

    public function __construct($jobId, \Generator $coroutine, $priority = 1.0)
    {
        $this->jobId = $jobId;
        $this->priority = $priority;
        $this->coroutine = $coroutine;
    }

    public function getJobId()
    {
        return $this->jobId;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function setSendValue($sendValue)
    {
        $this->sendValue = $sendValue;
    }

    public function run()
    {
        if ($this->initialInteration) {
            $this->initialInteration = false;
            return $this->coroutine->current();
        }

        $res = $this->coroutine->send($this->sendValue);
        $this->setSendValue(null);
        return $res;
    }

    public function isFinished()
    {
        return !$this->coroutine->valid();
    }


}