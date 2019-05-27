<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

namespace think\queue;

use DateTime;
use think\Config;

abstract class Job
{

    /**
     * The Job handler instance.
     * @var mixed
     */
    protected $instance;

    /**
     * The name of the queue the Job belongs to.
     * @var string
     */
    protected $queue;

    /**
     * Indicates if the Job has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * Indicates if the Job has been released.
     * @var bool
     */
    protected $released = false;

    /**
     * Fire the Job.
     * @return void
     */
    abstract public function fire();

    /**
     * Delete the Job from the queue.
     * @return void
     */
    public function delete()
    {
        $this->deleted = true;
    }

    /**
     * Determine if the Job has been deleted.
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Release the Job back into the queue.
     * @param  int $delay
     * @return void
     */
    public function release($delay = 0)
    {
        $this->released = true;
    }

    /**
     * Determine if the Job was released back into the queue.
     * @return bool
     */
    public function isReleased()
    {
        return $this->released;
    }

    /**
     * Determine if the Job has been deleted or released.
     * @return bool
     */
    public function isDeletedOrReleased()
    {
        return $this->isDeleted() || $this->isReleased();
    }

    /**
     * Get the number of times the Job has been attempted.
     * @return int
     */
    abstract public function attempts();

    /**
     * Get the raw body string for the Job.
     * @return string
     */
    abstract public function getRawBody();

    /**
     * Resolve and fire the Job handler method.
     * @param  array $payload
     * @return void
     */
    protected function resolveAndFire(array $payload)
    {
        list($class, $method) = $this->parseJob($payload['Job']);

        $this->instance = $this->resolve($class);
        if ($this->instance) {
            $this->instance->{$method}($this, $payload['data']);
        }
    }

    /**
     * Parse the Job declaration into class and method.
     * @param  string $job
     * @return array
     */
    protected function parseJob($job)
    {
        $segments = explode('@', $job);

        return count($segments) > 1 ? $segments : [$segments[0], 'fire'];
    }

    /**
     * Resolve the given Job handler.
     * @param  string $name
     * @return mixed
     */
    protected function resolve($name)
    {
        if (strpos($name, '\\') === false) {

            if (strpos($name, '/') === false) {
                $module = '';
            } else {
                list($module, $name) = explode('/', $name, 2);
            }

            $name = Config::get('app_namespace') . ($module ? '\\' . strtolower($module) : '') . '\\Job\\' . $name;
        }
        if (class_exists($name)) {
            return new $name();
        }
    }

    /**
     * Call the failed method on the Job instance.
     * @return void
     */
    public function failed()
    {
        $payload = json_decode($this->getRawBody(), true);

        list($class, $method) = $this->parseJob($payload['Job']);

        $this->instance = $this->resolve($class);
        if ($this->instance && method_exists($this->instance, 'failed')) {
            $this->instance->failed($payload['data']);
        }
    }

    /**
     * Calculate the number of seconds with the given delay.
     * @param  \DateTime|int $delay
     * @return int
     */
    protected function getSeconds($delay)
    {
        if ($delay instanceof DateTime) {
            return max(0, $delay->getTimestamp() - $this->getTime());
        }

        return (int) $delay;
    }

    /**
     * Get the current system time.
     * @return int
     */
    protected function getTime()
    {
        return time();
    }

    /**
     * Get the name of the queued Job class.
     * @return string
     */
    public function getName()
    {
        return json_decode($this->getRawBody(), true)['Job'];
    }

    /**
     * Get the name of the queue the Job belongs to.
     * @return string
     */
    public function getQueue()
    {
        return $this->queue;
    }
}
