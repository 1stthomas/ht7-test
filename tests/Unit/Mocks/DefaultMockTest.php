<?php

namespace Ht7\Test\Tests\Mocks;

use Ht7\Test\Mocks\DefaultMock;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @psalm-template RealInstanceType of object
 */
final class DefaultMockTest extends TestCase
{
    #[Test]
    #[TestDox('Create a default mock with triggering the constructor.')]
    // #[DataProvider('createWithConstructProvider')]
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
    }
    #[Test]
    #[TestDox('Create a default mock without triggering the constructor.')]
    // #[DataProvider('createWithoutConstructProvider')]
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
    //     public function create(array $setup): void
    //     {
    //     // MockBuilder" is declared "final" and cannot be doubled
    //     // sad!!
    //     $mockBuilder = $this->getMockBuilder(MockBuilder::class)
    //         ->onlyMethods(['onlyMethods', 'disableOriginalConstructor', 'setConstructorArgs', 'getMock'])
    //         ->disableOriginalConstructor()
    //         ->getMock();
    //     $mockBuilder->expects($this->once())
    //             ->method('onlyMethods')
    //             ->with($this->equalTo($setup['onlyMethods']['args']));
    //     if ($setup['constructorArgs'] === null) {
    //         $mockBuilder->expects($this->once())
    //             ->method('disableOriginalConstructor');
    //         $mockBuilder->expects($this->never())
    //             ->method('setConstructorArgs');
    //     } else {
    //         $mockBuilder->expects($this->never())
    //             ->method('disableOriginalConstructor');
    //         $mockBuilder->expects($this->once())
    //             ->method('setConstructorArgs')
    //             ->with($this->equalTo($setup['constructorArgs']));
    //     }
    //     /** @var DefaultMock $sut */
    //     $sut = $this->getMockBuilder($this->className)
    //         ->onlyMethods(['getMockBuilder'])
    //         ->setConstructorArgs([$setup['className']])
    //         ->getMock();
    //     $mockBuilder->expects($this->once())
    //             ->method('getMockBuilder')
    //             ->willReturn($mockBuilder);
    //     // $sut = new $this->className($setup['className']);
    //     $sut->create($setup['onlyMethods']['args'], $setup['constructorArgs']);
    // }
    // public static function createProvider(): array
    // {
    //     return [
    //         'simple mock.' => [
    //             'setup' => [
    //                 'className' => DefaultMock::class,
    //                 'constructorArgs' => null,
    //                 'onlyMethods' => [
    //                     'count' => 1,
    //                     'args' => ['setClassName'],
    //                 ],
    //             ],
    //             // 'expected' => [

    //             // ],
    //         ],
    //     ];
    // }
}

class TestHelperWithConstruct
{
    public function __construct(private string $test)
    {
    }
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
