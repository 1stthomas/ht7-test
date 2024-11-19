<?php

namespace Ht7\Test\Mocks;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\MockBuilder;

/**
 * @psalm-template RealInstanceType of object
 */
class DefaultMock
{
    /**
     * @psalm-param class-string<RealInstanceType> $className
     */
    public function __construct(private TestCase $testCase, private string $className) {}
    /**
     * @psalm-param list<non-empty-string> $methods
     * @param   array<int, string>   $methods            The methods to mock.
     * @param   array<string, mixed>   $constructorArgs    The arguments for the constructor.
     * @return  MockObject
     */
    public function create(array $methods = [], ?array $constructorArgs = null): MockObject
    {
        $mb = $this->testCase->getMockBuilder($this->className)
            ->onlyMethods($methods);
        $constructorArgs === null ? $mb->disableOriginalConstructor() : $mb->setConstructorArgs($constructorArgs);
        
        return $mb->getMock();
    }
    /**
     * @psalm-param class-string<RealInstanceType> $className
     */
    public function setClassName(string $className): static
    {
        $this->className = $className;

        return $this;
    }
}
