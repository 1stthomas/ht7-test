<?php

declare(strict_types=1);

namespace Ht7\Test\Tests\Mocks;

use Ht7\Test\Mocks\DefaultMock;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-template RealInstanceType of object
 *
 * @internal
 *
 * @covers \Ht7\Test\Mocks\DefaultMock::create
 */
#[CoversClass(DefaultMock::class)]
final class DefaultMockTest extends TestCase
{
    /** @psalm-var class-string<object> */
    private string $className = DefaultMock::class;

    #[Test]
    #[TestDox('Create a default mock with triggering the constructor.')]
    public function createWithConstruct(): void
    {
        $msg = ' - and what?';
        $expected = 'from test1';
        $sut = new DefaultMock($this, TestHelperWithConstruct::class);
        $mock = $sut->create(['getTest1'], ['test' => 'Initial test text']);
        $mock->expects($this->once())
            ->method('getTest1')
            ->with($msg)
            ->willReturn($expected);

        /** @var MockObject&TestHelperWithoutConstruct $mock */
        $this->assertSame($expected, $mock->getTest1($msg));
        $this->assertTrue(false);
    }

    #[Test]
    #[TestDox('Create a default mock without triggering the constructor.')]
    /**
     * @covers \Ht7\Test\Mocks\DefaultMock::create
     */
    public function createWithoutConstruct(): void
    {
        $msg = ' - and what?';
        $expected = 'from test1';
        $sut = new DefaultMock($this, TestHelperWithoutConstruct::class);
        $mock = $sut->create(['getTest1']);
        $mock->expects($this->once())
            ->method('getTest1')
            ->with($msg)
            ->willReturn($expected);

        /** @var MockObject&TestHelperWithoutConstruct $mock */
        $this->assertSame($expected, $mock->getTest1($msg));
    }

    #[Test]
    #[TestDox('Set the class name.')]
    /**
     * @covers \Ht7\Test\Mocks\DefaultMock::setClassName
     */
    public function setClassName(): void
    {
        $sut = $this->getMockBuilder($this->className)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();

        /** @var DefaultMock<RealInstanceType>&MockObject $sut */
        $return = $sut->setClassName($this->className);

        $this->assertSame($sut, $return);
        $getClassName = fn(): string => $this->className;
        // @phpstan-ignore method.resultUnused
        $getClassName->bindTo($sut, $sut);
        $name = $getClassName();
        // $isNew = $getClassName->bindTo($sut, $sut);
        // unset($isNew);
        $this->assertSame($this->className, $name);
    }
}

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
