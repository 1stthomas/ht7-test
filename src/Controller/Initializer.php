<?php

namespace Ht7\Test\Controller;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Description of Initializer
 *
 * @author Thomas Pluess
 */
class Initializer
{

    private static $instance;
    private $testClassTasks;

    public function __construct()
    {
        $this->testClassTasks = [
            'start' => [],
            'methods' => [],
            'finish' => []
        ];
    }

    /**
     *
     * @return Initializer
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Initializer();
        }

        return self::$instance;
    }

    public static function getTestData($method)
    {
        $methodParts = explode('::', $method);
        $methodName = count($methodParts) === 2 ? $methodParts[1] : $method;
        $methods = self::getInstance()->getTestClassTask('methods');

        if (!empty($methods[$methodName])) {
            return $methods[$method];
        } else {
            $e = 'Undefined method ' . $method . '.';

            throw new InvalidArgumentException($e);
        }
    }

    public function makeFinish()
    {
        // @todo: do the finish tasks.
    }

    public function makeStart()
    {
        Task::handleTasks($this->getTestClassTask('start')->getTasks());
    }

    public function makeTest($data)
    {
        if (!empty($data['data'])) {
            $data = $data['data'];
        }

        Task::handleTasks($data);
    }

    public static function reset()
    {
        self::$instance = null;
    }

    public function setUp(TestCase $tc, $path)
    {
        if (!empty($this->getTestClassTask('methods'))) {
            return;
        }

        if ($tc === null) {
            $e = 'The test case class must not be null.';

            throw InvalidArgumentException($e);
        } elseif (!is_string($path)) {
            $e = 'Unsupported datatype ' . gettype($path) . '. The path has to be a string.';

            throw new InvalidArgumentException($e);
        }

        Task::setTestCase($tc);

        $content = file_get_contents($path);
        $arr = json_decode($content, true);

        $this->setupFinish($arr);
        $this->setupStart($arr);
        $this->setupTestMethods($arr);
    }

    protected function addTestClassTasks($name, $tasks)
    {
        if (isset($this->testClassTasks[$name])) {
            $this->testClassTasks[$name] = $tasks;
        } else {
            throw new InvalidArgumentException('Wrong task name ' . $name);
        }
    }

    protected function getTestClassTask($name)
    {
        if (isset($this->testClassTasks[$name])) {
            return $this->testClassTasks[$name];
        } else {
            throw new InvalidArgumentException('Wrong task name ' . $name);
        }
    }

    protected function setupFinish(array $data)
    {
        if (!empty($data['finish'])) {
            $finish = Task::createTasks($data['finish']);

            $this->addTestClassTasks('finish', $finish);
        }
    }

    protected function setupStart(array $data)
    {
        if (!empty($data['start'])) {
            $start = Task::createTasks($data['start']);

            $this->addTestClassTasks('start', $start);
        }
    }

    protected function setupTestMethods(array $data)
    {
        if (!empty($data['methods'])) {
            $methods = Method::createMethods($data['methods']);

            $this->addTestClassTasks('methods', $methods);
        }
    }

}
