<?php

namespace Ht7\Test\Tests\Unit\Model;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Test\Model\Exc;
use \Ht7\Test\Model\Instance;
use \Ht7\Test\Tests\Utility\Traits\CanDoTest;

/**
 * Test class for the Instance model class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class InstanceTest extends TestCase
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
        $this->object = new Instance([]);
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
                        'class' => Instance::class,
                        'comment' => 'Constructor',
                        'compareData' => Exc::class,
                        'methodName' => 'getClass',
                        'options' => [],
                        'parameters' => [],
                        'parameters_constructor' => [
                            [
                                'class' => Exc::class,
                                'id' => 11111,
                                'parameters' => ['class' => InvalidArgumentException::class]
                            ]
                        ]
                    ],
                    [
                        'assertion' => 'eq',
                        'compareData' => 11111,
                        'methodName' => 'getId',
                    ],
                    [
                        'assertion' => 'eq',
                        'compareData' => ['class' => InvalidArgumentException::class],
                        'methodName' => 'getParameters',
                    ],
                ]
            ],
            'run2' => [
                'data' => [
                    [
                        'assertion' => 'eq',
                        'class' => Instance::class,
                        'comment' => 'Constructor',
                        'compareData' => 11111,
                        'exception' => InvalidArgumentException::class,
                        'methodName' => 'getId',
                        'options' => [],
                        'parameters' => [],
                        'parameters_constructor' => [
                            [
                                'class' => Exc::class,
                                'id' => 11111,
                                'parameters' => ['class' => InvalidArgumentException::class],
                                'test' => 'will fail'
                            ]
                        ]
                    ],
                ],
            ],
            'run3' => [
                'data' => [
                    [
                        'class' => Instance::class,
                        'comment' => 'Constructor',
                        'exception' => InvalidArgumentException::class,
                        'methodName' => 'setClass',
                        'parameters' => [1110],
                        'parameters_constructor' => [[]]
                    ],
                ],
            ],
        ];
    }

}
