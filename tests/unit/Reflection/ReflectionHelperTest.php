<?php

namespace Ht7\Test\Tests\Reflection;

use Ht7\Test\Reflection\ReflectionHelper;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;

class ReflectionHelperTest extends TestCase
{
    private string $className = ReflectionHelper::class;
    #[Test]
    #[TestDox('Create a reflection helper instance')]
    public function constructor(): void
    {
        $sut = new ReflectionHelper($this->className);

        $this->assertTrue(isset($sut->reflectedClass), 'reflected class created.');
        $this->assertSame($this->className, $sut->reflectedClass->getName(), 'reflected class name is ' . $this->className . '.');
    }
    #[Test]
    #[TestDox('Get the constructor method instance')]
    #[DataProvider('getConstructorProvider')]
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
    public function getProperty(?bool $isAccessable): void
    {
        list($sut, $reflectedProperty) = $this->getSutAndReflected($isAccessable, 'getProperty', 'testprop', \ReflectionProperty::class);

        /** @var ReflectionHelper $sut */
        $property = $sut->getProperty('testprop', $isAccessable);

        $this->assertSame($reflectedProperty, $property, 'reflection property created.');
    }
    final public static function getConstructorProvider(): array
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
    final public static function getMethodProvider(): array
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
    final public static function getPropertyProvider(): array
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
    private function getSutAndReflected(?bool $isAccessable, string $method, $name = null, string $returnClass = \ReflectionMethod::class): array
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
        $reflectedClass = $this->getMockBuilder(\ReflectionClass::class)
            ->onlyMethods([$method])
            ->disableOriginalConstructor()
            ->getMock();
        $invoc = $reflectedClass->expects($this->once())
            ->method($method)
            ->willReturn($returnFromReflection);
        if ($name !== null) {
            $invoc->with($name);
        }
        /** @var ReflectionHelper $sut */
        $sut = $this->getMockBuilder($this->className)
            ->onlyMethods([])
            ->setConstructorArgs([$reflectedClass])
            ->getMock();

        return [$sut, $returnFromReflection];
    }
}
