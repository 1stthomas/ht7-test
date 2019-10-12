<?php

namespace Ht7\Test\Controller;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Test\Container\IStorage;
use \Ht7\Test\Container\Tasks;
use \Ht7\Test\Container\Variables;
use \Ht7\Test\Model\Assertion;
use \Ht7\Test\Model\Container;
use \Ht7\Test\Model\Exc;
use \Ht7\Test\Model\Instance;
use \Ht7\Test\Model\MethodGet;
use \Ht7\Test\Model\MethodVoid;
use \Ht7\Test\Model\PropertyGet;
use \Ht7\Test\Model\PropertyVoid;

/**
 * Description of Task
 *
 * @author Thomas Pluess
 */
class Task
{

    protected static $storage;
    protected static $testCase;

    public static function createTasks(array $data)
    {
        if (empty($data)) {
            $e = 'Empty tasks array.';

            throw new InvalidArgumentException($e);
        }

        $tasks = new Tasks();

        foreach ($data as $tData) {
            $task = static::createTask($tData);

            $tasks->addTask($task);
        }

        return $tasks;
    }

    /**
     *
     * @return IStorage
     */
    public static function getStorage()
    {
        if (static::$storage === null) {
            static::$storage = new Variables();
        }

        return static::$storage;
    }

    /**
     *
     * @return TestCase
     */
    public static function getTestCase()
    {
        return static::$testCase;
    }

    public static function handleTasks($tasks)
    {
        foreach ($tasks as $task) {
            static::handleTask($task);
        }
    }

    public static function setStorage(IStorage $storage)
    {
        static::$storage = $storage;
    }

    public static function setTestCase(TestCase $tc)
    {
        static::$testCase = $tc;
    }

    protected static function createTask(array $data)
    {
        if (!self::validateTask($data)) {
            $e = 'Invalid task data.';

            throw new InvalidArgumentException($e);
        }

        $taskName = $data['task'];
        unset($data['task']);
        $task = null;

        if ($taskName === 'assertion') {
            $task = new Assertion($data);
        } elseif ($taskName === 'container') {
            $task = new Container($data);
        } elseif ($taskName === 'exception') {
            $task = new Exc($data);
        } elseif ($taskName === 'instance') {
            $task = new Instance($data);
        } elseif ($taskName === 'method') {
            if (empty($data['task-spec']) || $data['task-spec'] !== 'get') {
                if (isset($data['task-spec'])) {
                    unset($data['task-spec']);
                }

                $task = new MethodVoid($data);
            } else {
                unset($data['task-spec']);

                $task = new MethodGet($data);
            }
        } elseif ($taskName === 'property') {
            if (empty($data['task-spec']) || $data['task-spec'] !== 'get') {
                if (isset($data['task-spec'])) {
                    unset($data['task-spec']);
                }

                $task = new PropertyVoid($data);
            } else {
                unset($data['task-spec']);

                $task = new PropertyGet($data);
            }
        }

        return $task;
    }

    protected static function handleTask($task)
    {
        $className = get_class($task);

        if ($className === Assertion::class) {
            // Here we need a TestCase instance to do the assertion..
            // We should store the TestCase instance also into the container!

            $asserted = $task->getValueAsserted();
            $expected = $task->getValueExpected();

            if (is_string($asserted) && strpos($asserted, '{id:') === 0) {
                $id = rtrim(ltrim($asserted, '{id:'), '}');
                $asserted = static::getStorage()->getVariable($id);
            }

            $types = Assertion::getTypes();
            $definitions = $types[$task->getType()];

            if (empty($definitions['has_one_param'])) {
                call_user_func_array([TestCase::class, $definitions['method']], [$asserted, $expected]);
            } else {
                call_user_func_array([TestCase::class, $definitions['method']], [$asserted]);
            }
        } elseif ($className === Container::class) {
            $id = $task->getId();
            $value = $task->getValue();

            static::getStorage()->addVariable($id, $value);
        } elseif ($className === Exc::class) {
            static::getTestCase()->expectException($task->getClass());
        } elseif ($className === Instance::class) {
            // Create the task.
            $className = $task->getClass();
            $id = $task->getId();
            $parameters = $task->getParameters();
            $task = new $className(...$parameters);

            // Store the task into the container.
            static::getStorage()->addVariable($id, $task);
        } elseif ($className === MethodGet::class) {
            // Create the task.
            $id = $task->getId();
            $instance = $task->getInstance();
            $methodName = $task->getName();
            $parameters = $task->getParameters();

            if ($instance === null) {
                $className = $task->getClass();

                $instance = new $className();
            } elseif (is_int($instance)) {
                $instance = self::getStorage()->getVariable($instance);
            }

            $variable = $instance->$methodName(...$parameters);

            static::getStorage()->addVariable($id, $variable);
        } elseif ($className === MethodVoid::class) {
            // Create the task.
            $instance = $task->getInstance();
            $methodName = $task->getName();
            $parameters = $task->getParameters();

            if ($instance === null) {
                $className = $task->getClass();

                $instance = new $className();
            } elseif (is_int($instance)) {
                $instance = self::getStorage()->getVariable($instance);
            }

            $instance->$methodName(...$parameters);
        } elseif ($className === PropertyGet::class) {
            $id = $task->getId();
            $instance = self::getStorage()->getVariable($task->getInstance());
            $propertyName = $task->getName();

            $property = $instance->{$propertyName};

            self::getStorage()->addVariable($id, $property);
        } elseif ($className === PropertyVoid::class) {
            $id = $task->getId();
            $instance = self::getStorage()->getVariable($task->getInstance());
            $propertyName = $task->getName();

            $instance->{$propertyName} = self::getStorage()->getVariable($id);
        }
    }

    protected static function validateTask(array $data)
    {
        if (empty($data)) {
            return false;
        } elseif (empty($data['task'])) {
            return false;
        } elseif ($data['task'] === 'method' && empty($data['task-spec'])) {
            return false;
        }

        return true;
    }

}
