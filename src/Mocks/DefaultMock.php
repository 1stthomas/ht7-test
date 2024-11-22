<?php

declare(strict_types=1);

namespace Ht7\Test\Mocks;

use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

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
     *
     * @param array<int, string>   $methods         the methods to mock
     * @param array<string, mixed> $constructorArgs the arguments for the constructor
     */
    public function create(array $methods = [], ?array $constructorArgs = null): MockObject
    {
        $mb = (new MockBuilder($this->testCase, $this->className))
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
