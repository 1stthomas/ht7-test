<?php

namespace Ht7\Test\Tests\Unit\Model;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Test\Model\Exc;
use \Ht7\Test\Model\MethodGet;
use \Ht7\Test\Model\MethodVoid;

/**
 * Test class for the Method model class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class MethodTest extends TestCase
{

    /**
     * @var \Ht7\Test\Model\MethodGet
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new MethodGet([]);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers Ht7\Test\Utility\Traits\Constants\::__construct
     * @dataProvider constructorProvider
     */
    public function testConstructor(array $data)
    {
        $this->makeTest($data);
    }

    public function constructorProvider()
    {
        return [
            'run1' => [
                'data' => [
                    [
                        'assertion' => 'eq',
                        'class' => MethodGet::class,
                        'comment' => 'Constructor',
                        'compareData' => Exc::class,
                        'methodName' => 'getClass',
                        'options' => [],
                        'parameters' => [],
                        'parameters_constructor' => [
                            [
                                'class' => Exc::class,
                                'id' => 11112,
                                'instance' => 11111,
                                'name' => 'getClass',
//                                'parameters' => ['class' => InvalidArgumentException::class]
                            ]
                        ]
                    ],
                    [
                        'assertion' => 'eq',
                        'compareData' => 11111,
                        'methodName' => 'getInstance',
                    ],
                    [
                        'assertion' => 'eq',
                        'compareData' => 'getClass',
                        'methodName' => 'getName',
                    ],
                ]
            ],
            'run2' => [
                'data' => [
                    [
                        'assertion' => 'eq',
                        'class' => MethodGet::class,
                        'comment' => 'Setting an unsupported property throws an exception',
                        'exception' => InvalidArgumentException::class,
                        'parameters_constructor' => [
                            [
                                'class' => Exc::class,
                                'instance' => 11111,
                                'name' => 'getClass',
                                'test' => 'will fail'
                            ]
                        ]
                    ],
                ],
            ],
            'run3' => [
                'data' => [
                    [
                        'assertion' => 'eq',
                        'class' => 'object',
                        'comment' => 'get class is empty',
                        'compareData' => null,
                        'methodName' => 'getClass',
                    ],
                    [
                        'assertion' => 'eq',
                        'class' => 'object',
                        'class_tasks' => [
                            [
                                'method' => 'setClass',
                                'parameters' => [Exc::class]
                            ]
                        ],
                        'comment' => 'class set, should not be empty anymore',
                        'compareData' => Exc::class,
                        'methodName' => 'getClass'
                    ],
                ],
            ],
            'run4' => [
                'data' => [
                    [
                        'assertion' => 'eq',
                        'class' => MethodVoid::class,
                        'comment' => 'Constructor',
                        'compareData' => 11111,
                        'methodName' => 'getInstance',
                        'options' => [],
                        'parameters' => [],
                        'parameters_constructor' => [
                            [
                                'class' => Exc::class,
                                'instance' => 11111,
                                'name' => 'getClass',
                            ]
                        ]
                    ],
                ],
            ],
        ];
    }

    protected function makeTest(array $calls)
    {
        $testObj = null;

        foreach ($calls as $data) {
            if (!empty($data['exception'])) {
                $this->expectException($data['exception']);
            }

//            print_r($data);

            if (!empty($data['class'])) {
                if ($data['class'] === 'object') {
                    $testObj = $this->object;
                } else {
                    if (empty($data['parameters_constructor'])) {
                        $testObj = new $data['class']();
                    } else {
                        // @see https://stackoverflow.com/questions/8734522/dynamically-call-class-with-variable-number-of-parameters-in-the-constructor#answer-8735314
                        $testObj = new $data['class'](...$data['parameters_constructor']);
                    }
                }
            }

            if (!empty($data['class_tasks'])) {
                foreach ($data['class_tasks'] as $task) {
                    if (!empty($task['method'])) {
                        $parameters = empty($task['parameters']) ? [] : $task['parameters'];

                        call_user_func_array([$testObj, $task['method']], $parameters);
                    }
                }
            }

            $data['parameters'] = empty($data['parameters']) ? [] : $data['parameters'];

            $testValue = call_user_func_array([$testObj, $data['methodName']], $data['parameters']);

//            print_r("\n\n testV:\n");
//            print_r($testValue);
//            print_r("\n\n compare:\n");
//            print_r($data['compareData']);
//            print_r("\n\n");

            if ($data['assertion'] === 'eq') {
                $this->assertEquals($testValue, $data['compareData']);
            }
        }
    }

}
