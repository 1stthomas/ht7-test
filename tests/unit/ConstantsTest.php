<?php

namespace Ht7\Test\Tests;

use \PHPUnit\Framework\TestCase;
use \Ht7\Test\Tests\Utility\Traits\ConstantsParent;
use \Ht7\Test\Tests\Utility\Traits\ConstantsChild1;

/**
 * Test class for the Constants trait.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class ConstantsTest extends TestCase
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
        $this->object = new ConstantsChild1();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers Ht7\Test\Utility\Traits\Constants\::getConstants
     * @dataProvider getConstantsByTypeProvider
     */
    public function testGetConstantsByType(array $data)
    {
        $this->makeHt7Test($data);
    }

    /**
     * @covers Ht7\Test\Utility\Traits\Constants\::getConstants
     * @dataProvider getConstantsProvider
     */
    public function testGetConstants(array $data)
    {
        $this->makeHt7Test($data);
    }

    public function getConstantsByTypeProvider()
    {
        return [
            [
                [
                    'assertion' => 'eq',
                    'class' => ConstantsChild1::class,
                    'comment' => 'Child',
                    'compareData' => [
                        'HT7_TEST_TESTS_CTYPE_B1' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B1,
                        'HT7_TEST_TESTS_CTYPE_B2' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B2,
                        'HT7_TEST_TESTS_CTYPE_B3' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B3
                    ],
                    'methodName' => 'getConstantsByType',
                    'options' => [],
                    'parameters' => ['HT7_TEST_TESTS_CTYPE_B']
                ]
            ],
            [
                [
                    'assertion' => 'eq',
                    'class' => ConstantsChild1::class,
                    'comment' => 'Child',
                    'compareData' => [
                        'HT7_TEST_TESTS_CTYPE_B3' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B3
                    ],
                    'methodName' => 'getConstantsByType',
                    'options' => [],
                    'parameters' => ['HT7_TEST_TESTS_CTYPE_B3']
                ]
            ],
            [
                [
                    'assertion' => 'eq',
                    'class' => ConstantsChild1::class,
                    'comment' => 'Child',
                    'compareData' => [
                        'HT7_TEST_TESTS_CTYPE_B1' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B1,
                        'HT7_TEST_TESTS_CTYPE_B2' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B2,
                        'HT7_TEST_TESTS_CTYPE_B3' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B3
                    ],
                    'methodName' => 'getConstantsByType',
                    'options' => [],
                    'parameters' => ['HT7_TEST_TESTS_CTYPE_', false]
                ]
            ],
            [
                [
                    'assertion' => 'eq',
                    'class' => ConstantsChild1::class,
                    'comment' => 'Child',
                    'compareData' => [],
                    'methodName' => 'getConstantsByType',
                    'options' => [],
                    'parameters' => ['HT7_TEST_TESTS_CTYPE_A', false]
                ]
            ],
            [
                [
                    'assertion' => 'eq',
                    'class' => ConstantsChild1::class,
                    'comment' => 'Child',
                    'compareData' => [
                        'HT7_TEST_TESTS_CTYPE_A1' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_A1,
                        'HT7_TEST_TESTS_CTYPE_A2' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_A2,
                        'HT7_TEST_TESTS_CTYPE_A3' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_A3
                    ],
                    'methodName' => 'getConstantsByType',
                    'options' => [],
                    'parameters' => ['HT7_TEST_TESTS_CTYPE_A']
                ]
            ]
        ];
    }

    public function getConstantsProvider()
    {
        return [
            [
                [
                    'assertion' => 'eq',
                    'class' => ConstantsChild1::class,
                    'comment' => 'Child',
                    'compareData' => [
                        'HT7_TEST_TESTS_CTYPE_A1' => ConstantsParent::HT7_TEST_TESTS_CTYPE_A1,
                        'HT7_TEST_TESTS_CTYPE_A2' => ConstantsParent::HT7_TEST_TESTS_CTYPE_A2,
                        'HT7_TEST_TESTS_CTYPE_A3' => ConstantsParent::HT7_TEST_TESTS_CTYPE_A3,
                        'HT7_TEST_TESTS_CTYPE_B1' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B1,
                        'HT7_TEST_TESTS_CTYPE_B2' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B2,
                        'HT7_TEST_TESTS_CTYPE_B3' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B3
                    ],
                    'methodName' => 'getConstants',
                    'options' => [],
                    'parameters' => []
                ]
            ],
            [
                [
                    'assertion' => 'eq',
                    'class' => ConstantsChild1::class,
                    'comment' => 'Child',
                    'compareData' => [
                        'HT7_TEST_TESTS_CTYPE_B1' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B1,
                        'HT7_TEST_TESTS_CTYPE_B2' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B2,
                        'HT7_TEST_TESTS_CTYPE_B3' => ConstantsChild1::HT7_TEST_TESTS_CTYPE_B3
                    ],
                    'methodName' => 'getConstants',
                    'options' => [],
                    'parameters' => ['includeAncestors' => false]
                ]
            ],
            [
                [
                    'assertion' => 'eq',
                    'class' => ConstantsParent::class,
                    'comment' => 'Parent',
                    'compareData' => [
                        'HT7_TEST_TESTS_CTYPE_A1' => ConstantsParent::HT7_TEST_TESTS_CTYPE_A1,
                        'HT7_TEST_TESTS_CTYPE_A2' => ConstantsParent::HT7_TEST_TESTS_CTYPE_A2,
                        'HT7_TEST_TESTS_CTYPE_A3' => ConstantsParent::HT7_TEST_TESTS_CTYPE_A3
                    ],
                    'methodName' => 'getConstants',
                    'options' => [],
                    'parameters' => []
                ]
            ]
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
