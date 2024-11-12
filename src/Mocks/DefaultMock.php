<?php

namespace Ht7\Test\Mocks;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class DefaultMock extends TestCase
{
    /**
     * @psalm-template RealInstanceType of object
     * @psalm-param class-string<RealInstanceType> $className
     */
    public function __construct(private string $className) {}
    /**
     * @psalm-param list<non-empty-string> $methods
     * @param   array<int, string>   $methods            The methods to mock.
     * @param   array<string, mixed>   $constructorArgs    The arguments for the constructor.
     * @return  MockObject
     */
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
