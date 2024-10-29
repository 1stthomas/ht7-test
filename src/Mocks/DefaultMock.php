<?php

namespace Ht7\Test\Mocks;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class DefaultMock extends TestCase
{
    public function __construct(private string $className) {}
    public function create(array $methods = [], ?array $constructorArgs = null): MockObject
    {
        $mb = $this->getMockBuilder($this->className)
            ->onlyMethods($methods);

        $constructorArgs === null ? $mb->disableOriginalConstructor() : $mb->setConstructorArgs($constructorArgs);

        return $mb->getMock();
    }
    public function setClassName(string $className): static
    {
        $this->className = $className;

        return $this;
    }
}
