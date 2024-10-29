<?php

namespace Ht7\Test\Tests\Mocks;

class TestHelperWithConstruct
{
    public function __construct(private string $test) {}
    public function getTest1(string $additional): string
    {
        return $this->test . ' ' . $additional;
    }
    public function getTest2(string $additional): string
    {
        return $this->getTest1($additional);
    }
}
