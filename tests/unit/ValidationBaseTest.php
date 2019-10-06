<?php

namespace Ht7\Test\Tests;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Test\Tests\Utility\Traits\ValidationBaseHelper;

/**
 * Test class for the ValidationBase trait.
 *
 * @author 1stthomas
 */
class ValidationBaseTest extends TestCase
{

    /**
     * @var Ht7\Test\JsonParser
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ValidationBaseHelper();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers Ht7\Test\Utility\Traits\ValidationBase::validateDatatype
     * @dataProvider validateDatatypeProvider
     */
    public function testValidateDatatype(array $data)
    {
        $this->makeHt7Test($data);
    }

    /**
     * @covers Ht7\Test\Utility\Traits\ValidationBase::validateDatatype
     * @dataProvider validateNotEmptyProvider
     */
    public function testValidateNotEmpty(array $data)
    {
        $this->makeHt7Test($data);
    }

    public function validateDatatypeProvider()
    {
        return [
            [
                [
                    'assertion' => 'eq',
                    'class' => 'object',
                    'class_tasks' => [
                        [
                            'method' => 'setArray',
                            'parameters' => [
                                ['one', 'two', 'three']
                            ]
                        ],
                        [
                            'method' => 'setBoolean',
                            'parameters' => [true]
                        ],
                        [
                            'method' => 'setFloat',
                            'parameters' => [12.345]
                        ],
                        [
                            'method' => 'setInteger',
                            'parameters' => ['int' => 11]
                        ],
                        [
                            'method' => 'setObject',
                            'parameters' => [new \stdClass()]
                        ],
                        [
                            'method' => 'setString',
                            'parameters' => ['Test string']
                        ],
                    ],
                    'comment' => 'Datatype validation test',
                    'compareData' => [
                        'arr' => ['one', 'two', 'three'],
                        'boolean' => true,
                        'float' => 12.345,
                        'integer' => 11,
                        'object' => new \stdClass(),
                        'string' => 'Test string'
                    ],
                    'methodName' => 'getProperties',
                    'options' => [],
                    'parameters' => []
                ]
            ],
            [
                [
                    'assertion' => 'eq',
                    'class' => 'object',
                    'class_tasks' => [
                        [
                            'method' => 'setArray',
                            'parameters' => ['kein array']
                        ],
                    ],
                    'comment' => 'Datatype validation test',
                    'compareData' => [
                        'arr' => [],
                        'boolean' => null,
                        'float' => null,
                        'integer' => null,
                        'object' => null,
                        'string' => null
                    ],
                    'exception' => InvalidArgumentException::class,
                    'methodName' => 'getProperties',
                    'options' => [],
                    'parameters' => []
                ]
            ],
            [
                [
                    'assertion' => 'eq',
                    'class' => 'object',
                    'class_tasks' => [
                        [
                            'method' => 'setInteger',
                            'parameters' => [1.23]
                        ],
                    ],
                    'comment' => 'Datatype validation test',
                    'compareData' => [
                        'arr' => [],
                        'boolean' => null,
                        'float' => null,
                        'integer' => null,
                        'object' => null,
                        'string' => null
                    ],
                    'exception' => InvalidArgumentException::class,
                    'methodName' => 'getProperties',
                    'options' => [],
                    'parameters' => []
                ]
            ],
            [
                [
                    'assertion' => 'eq',
                    'class' => 'object',
                    'class_tasks' => [
                        [
                            'method' => 'setFloat',
                            'parameters' => [123]
                        ],
                    ],
                    'comment' => 'Datatype validation test',
                    'compareData' => [
                        'arr' => [],
                        'boolean' => null,
                        'float' => null,
                        'integer' => null,
                        'object' => null,
                        'string' => null
                    ],
                    'exception' => InvalidArgumentException::class,
                    'methodName' => 'getProperties',
                    'options' => [],
                    'parameters' => []
                ]
            ],
        ];
    }

    public function validateNotEmptyProvider()
    {
        return [
            [
                [
                    'assertion' => 'eq',
                    'class' => 'object',
                    'class_tasks' => [
                        [
                            'method' => 'setNotEmptyArray',
                            'parameters' => [
                                ['one', 'two', 'three']
                            ]
                        ],
                    ],
                    'comment' => 'Not empty validation test',
                    'compareData' => ['one', 'two', 'three'],
                    'methodName' => 'getArray',
                    'options' => [],
                    'parameters' => []
                ]
            ],
            [
                [
                    'assertion' => 'eq',
                    'class' => 'object',
                    'class_tasks' => [
                        [
                            'method' => 'setNotEmptyArray',
                            'parameters' => [
                                []
                            ]
                        ],
                    ],
                    'comment' => 'Not empty validation test',
                    'compareData' => [],
                    'exception' => InvalidArgumentException::class,
                    'methodName' => 'getArray',
                    'options' => [],
                    'parameters' => []
                ]
            ],
            [
                [
                    'assertion' => 'eq',
                    'class' => 'object',
                    'class_tasks' => [
                        [
                            'method' => 'setValidationReportType',
                            'parameters' => [2]
                        ],
                    ],
                    'comment' => 'Not empty validation test',
                    'compareData' => 'Empty array found.',
                    'methodName' => 'setNotEmptyArray',
                    'options' => [],
                    'parameters' => [[]]
                ]
            ],
            [
                [
                    'assertion' => 'eq',
                    'class' => 'object',
                    'class_tasks' => [
                        [
                            'method' => 'setValidationReportType',
                            'parameters' => [3]
                        ],
                    ],
                    'comment' => 'Not empty validation test',
                    'compareData' => false,
                    'methodName' => 'setNotEmptyArray',
                    'options' => [],
                    'parameters' => [[]]
                ]
            ],
        ];
    }

    protected function makeHt7Test(array $data)
    {
        if (!empty($data['exception'])) {
            $this->expectException($data['exception']);
        }

//        print_r($data);

        if ($data['class'] === 'object') {
            $testObj = $this->object;
        } else {
            $testObj = new $data['class']();
        }

        if (!empty($data['class_tasks'])) {
            foreach ($data['class_tasks'] as $task) {
                if (!empty($task['method'])) {
                    $parameters = empty($task['parameters']) ? [] : $task['parameters'];

                    call_user_func_array([$testObj, $task['method']], $parameters);
                }
            }
        }

        $testValue = call_user_func_array([$testObj, $data['methodName']], $data['parameters']);

        if ($data['assertion'] === 'eq') {
            $this->assertEquals($testValue, $data['compareData']);
        }
    }

}
