<?php

namespace Ht7\Test\Tests\Mocks;

class TestHelperWithoutConstruct
{
    public function __construct()
    {
        throw new \Exception('This class should not be instantiated.');
    }
    public function getTest1(string $additional): string
    {
        return 'test ' . $additional;
    }
    public function getTest2(string $additional): string
    {
        return $this->getTest1($additional);
    }
}
