<?php

namespace Ht7\Test\Tests\Integration;

use \PHPUnit\Framework\TestCase;
use \Ht7\Test\Controller\Initializer;

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

    public $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'run' . DIRECTORY_SEPARATOR . 'test01.json';

    public function __construct($name = NULL,
            array $data = array(),
            $dataName = '')
    {
        Initializer::getInstance()->setUp($this, $this->path);

        parent::__construct(...func_get_args());
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        Initializer::getInstance()->makeStart();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        Initializer::getInstance()->makeFinish();
    }

    /**
     * @dataProvider constructorProvider
     */
    public function testConstructor(array $data)
    {
        Initializer::getInstance()->makeTest($data);
    }

    public function constructorProvider()
    {
//        print_r(Initializer::getInstance()->getTestData('testConstructor'));

        return Initializer::getInstance()->getTestData('testConstructor');
    }

}
