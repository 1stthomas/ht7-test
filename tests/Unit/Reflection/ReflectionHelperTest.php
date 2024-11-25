<?php

declare(strict_types=1);

namespace Ht7\Test\Tests\Reflection;

use Ht7\Test\Reflection\ReflectionHelper;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-template RealInstanceType of object
 *
 * @internal
 */
#[CoversClass(ReflectionHelper::class)]
final class ReflectionHelperTest extends TestCase
{
    /** @psalm-var class-string<object> */
    private string $className = ReflectionHelper::class;

    #[Test]
    #[TestDox('Create a reflection helper instance')]
    /**
     * @covers \Ht7\Test\Reflection\ReflectionHelper::__construct
     */
    public function constructor(): void
    {
        $sut = new ReflectionHelper($this->className);

        $this->assertSame($this->className, $sut->reflectedClass->getName(), 'reflected class name is ' . $this->className . '.');
    }

    #[Test]
    #[TestDox('Get the constructor method instance')]
    #[DataProvider('getConstructorProvider')]
    /**
     * @covers \Ht7\Test\Reflection\ReflectionHelper::getConstructor
     */
    public function getConstructor(?bool $isAccessable): void
    {
        list($sut, $reflectedConstructor) = $this->getSutAndReflected($isAccessable, 'getConstructor');

        /** @var ReflectionHelper $sut */
        $constructor = $sut->getConstructor($isAccessable);

        $this->assertSame($reflectedConstructor, $constructor, 'constructor reflection method created.');
    }

    #[Test]
    #[TestDox('Get a reflection method instance')]
    #[DataProvider('getMethodProvider')]
    /**
     * @covers \Ht7\Test\Reflection\ReflectionHelper::getMethod
     */
    public function getMethod(?bool $isAccessable): void
    {
        list($sut, $reflectedMethod) = $this->getSutAndReflected($isAccessable, 'getMethod', 'testmethod');

        /** @var ReflectionHelper $sut */
        $method = $sut->getMethod('testmethod', $isAccessable);

        $this->assertSame($reflectedMethod, $method, 'reflection method created.');
    }

    #[Test]
    #[TestDox('Get a reflection property instance')]
    #[DataProvider('getPropertyProvider')]
    /**
     * @covers \Ht7\Test\Reflection\ReflectionHelper::getProperty
     */
    public function getProperty(?bool $isAccessable): void
    {
        /**
         * @psalm-var class-string<RealInstanceType> $class
         */
        $class = \ReflectionProperty::class;
        list($sut, $reflectedProperty) = $this->getSutAndReflected($isAccessable, 'getProperty', 'testprop', $class);

        /** @var ReflectionHelper $sut */
        $property = $sut->getProperty('testprop', $isAccessable);

        $this->assertSame($reflectedProperty, $property, 'reflection property created.');
    }

    /**
     * @return array<string, mixed>
     */
    public static function getConstructorProvider(): array
    {
        return [
            'accessable constructor' => [
                'isAccessable' => true,
            ],
            'inaccessable constructor' => [
                'isAccessable' => false,
            ],
            'default constructor' => [
                'isAccessable' => null,
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function getMethodProvider(): array
    {
        return [
            'accessable method' => [
                'isAccessable' => true,
            ],
            'inaccessable method' => [
                'isAccessable' => false,
            ],
            'default method' => [
                'isAccessable' => null,
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function getPropertyProvider(): array
    {
        return [
            'accessable property' => [
                'isAccessable' => true,
            ],
            'inaccessable property' => [
                'isAccessable' => false,
            ],
            'default property' => [
                'isAccessable' => null,
            ],
        ];
    }

    /**
     * @psalm-param class-string<RealInstanceType> $returnClass
     *
     * @return array<int, object>
     */
    private function getSutAndReflected(?bool $isAccessable, string $method, ?string $name = null, string $returnClass = \ReflectionMethod::class): array
    {
        $returnFromReflection = $this->getMockBuilder($returnClass)
            ->onlyMethods(['setAccessible'])
            ->disableOriginalConstructor()
            ->getMock();
        if ($isAccessable === null) {
            $returnFromReflection->expects($this->never())
                ->method('setAccessible');
        } else {
            $returnFromReflection->expects($this->once())
                ->method('setAccessible')
                ->with($isAccessable);
        }

        /**
         * @psalm-var  list<non-empty-string> $methods
         */
        $methods = [$method];
        $reflectedClass = $this->getMockBuilder(\ReflectionClass::class)
            ->onlyMethods($methods)
            ->disableOriginalConstructor()
            ->getMock();
        $invoc = $reflectedClass->expects($this->once())
            ->method($method)
            ->willReturn($returnFromReflection);
        if ($name !== null) {
            $invoc->with($name);
        }

        /** @var MockObject&ReflectionHelper $sut */
        $sut = $this->getMockBuilder($this->className)
            ->onlyMethods([])
            ->setConstructorArgs([$reflectedClass])
            ->getMock();

        return [$sut, $returnFromReflection];
    }
}
