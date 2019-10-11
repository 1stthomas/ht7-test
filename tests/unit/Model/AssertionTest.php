<?php

namespace Ht7\Test\Tests\Unit\Model;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Test\Model\Assertion;
use \Ht7\Test\Tests\Utility\Traits\CanDoTest;

/**
 * Test class for the Exception model class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class AssertionTest extends TestCase
{

    use CanDoTest;

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
        $this->object = new Assertion([]);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function testConstants()
    {
        $rClass = new \ReflectionClass(Assertion::class);
        $constants = $rClass->getConstants();
        $count = count($constants);

        $flipped = array_flip($constants);

        $this->assertCount($count, $flipped);
    }

    /**
     * @covers Ht7\Test\Utility\Traits\Constants\::__construct
     * @dataProvider constructorProvider
     */
    public function testConstructor(array $data)
    {
        $this->makeTest($data);
    }

    /**
     * Test if there are duplicated assertion short names.
     */
    public function testGetTypes()
    {
        $types = Assertion::getTypes();
        $typesCountIndex = count($types);

        $typesTmp1 = array_map(function($item) {
            return $item['short'];
        }, $types);
        $typesFlipped1 = array_flip($typesTmp1);

        $this->assertCount($typesCountIndex, $typesFlipped1);

        $typesTmp2 = array_map(function($item) {
            return $item['method'];
        }, $types);
        $typesFlipped2 = array_flip($typesTmp2);

        $this->assertCount($typesCountIndex, $typesFlipped2);
    }

    public function constructorProvider()
    {
        return [
            'run1' => [
                'data' => [
                    [
                        'assertion' => 'eq',
                        'class' => Assertion::class,
                        'comment' => 'Constructor',
                        'compareData' => Assertion::ASSERT_EQUALS,
                        'methodName' => 'getType',
                        'options' => [],
                        'parameters' => [],
                        'parameters_constructor' => [['type' => 'eq']]
                    ],
                ],
            ],
            'run2' => [
                'data' => [
                    [
                        'assertion' => 'eq',
                        'class' => 'object',
                        'comment' => 'Constructor',
                        'compareData' => Assertion::ASSERT_EQUALS,
                        'methodName' => 'getType',
                        'parameters_constructor' => [['type' => Assertion::ASSERT_EQUALS]]
                    ],
                    [
                        'assertion' => 'eq',
                        'class' => 'object',
                        'class_tasks' => [
                            [
                                'method' => 'setType',
                                'parameters' => ['eq']
                            ]
                        ],
                        'comment' => 'Constructor',
                        'compareData' => Assertion::ASSERT_EQUALS,
                        'methodName' => 'getType',
                    ]
                ]
            ],
            'run3' => [
                'data' => [
                    [
                        'class' => Assertion::class,
                        'comment' => 'Constructor - will fail',
                        'exception' => InvalidArgumentException::class,
                        'parameters_constructor' => [['type' => 'eq', 'test' => 'will fail']]
                    ],
                ],
            ],
            'run4' => [
                'data' => [
                    [
                        'class' => Assertion::class,
                        'comment' => 'Constructor - will fail',
                        'exception' => InvalidArgumentException::class,
                        'parameters_constructor' => [['type' => 'eq1']]
                    ],
                ],
            ],
        ];
    }

}
