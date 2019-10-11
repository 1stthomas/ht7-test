<?php

namespace Ht7\Test\Controller;

use \InvalidArgumentException;

/**
 * Description of Task
 *
 * @author Thomas Pluess
 */
class Method
{

    /**
     * Get an array of method tasks.
     *
     * @param   array $data
     * @return  array                   Assoc array with the method names as keys
     *                                  and their tasks as values.
     * @throws InvalidArgumentException
     */
    public static function createMethods(array $data)
    {
        if (empty($data)) {
            $e = 'Empty methods array.';

            throw new InvalidArgumentException($e);
        }

        $methods = [];

        foreach ($data as $key => $mData) {
            $method = static::createMethod($mData);

            $methods[$key] = $method;
        }

        return $methods;
    }

    /**
     * Get an array of \Ht7\Test\Container\Tasks
     *
     * @param   array   $data           Indexed array of tasks for every method
     *                                  call.
     * @return  array                   Indexed array of task containers
     * @throws  InvalidArgumentException
     */
    protected static function createMethod(array $data)
    {
        $calls = [];

        foreach ($data as $key => $call) {
            $calls[$key] = ['data' => Task::createTasks($call)->getTasks()];
        }

        return $calls;
    }

}
