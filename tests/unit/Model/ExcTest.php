<?php

namespace Ht7\Test\Tests\Unit\Model;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Test\Model\Exc;
use \Ht7\Test\Tests\Utility\Traits\CanDoTest;

/**
 * Test class for the Exception model class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class ExcTest extends TestCase
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
        $this->object = new Exc([]);
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
            'run1a' => [
                'data' => [
                    [
                        'assertion' => 'eq',
                        'class' => Exc::class,
                        'comment' => 'Constructor',
                        'compareData' => InvalidArgumentException::class,
                        'methodName' => 'getClass',
                        'options' => [],
                        'parameters' => [],
                        'parameters_constructor' => [['class' => InvalidArgumentException::class]]
                    ],
                ],
            ],
            'run2a' => [
                'data' => [
                    [
                        'class' => Exc::class,
                        'comment' => 'Constructor',
                        'compareData' => InvalidArgumentException::class,
                        'exception' => InvalidArgumentException::class,
                        'methodName' => 'getClass',
                        'options' => [],
                        'parameters' => [],
                        'parameters_constructor' => [['class' => InvalidArgumentException::class, 'test' => 'will fail']]
                    ],
                ],
            ],
            'run3a' => [
                'data' => [
                    [
                        'class' => Exc::class,
                        'comment' => 'Constructor',
                        'compareData' => InvalidArgumentException::class,
                        'exception' => InvalidArgumentException::class,
                        'methodName' => 'getClass',
                        'options' => [],
                        'parameters' => [],
                        'parameters_constructor' => [['class' => 1110]]
                    ]
                ]
            ]
        ];
    }

}
