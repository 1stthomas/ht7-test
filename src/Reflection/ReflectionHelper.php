<?php

declare(strict_types=1);

namespace Ht7\Test\Reflection;

class ReflectionHelper
{
    /**
     * @template T of object
     *
     * @var \ReflectionClass<object>
     */
    public $reflectedClass;

    /**
     * @psalm-param class-string<object>|\ReflectionClass<object> $class
     */
    public function __construct(\ReflectionClass|string $class)
    {
        $this->reflectedClass = is_string($class) ? new \ReflectionClass($class) : $class;
    }

    public function getConstructor(?bool $isAccessable = true): ?\ReflectionMethod
    {
        $construct = $this->reflectedClass->getConstructor();

        $isAccessable === null || $construct === null ? '' : $construct->setAccessible($isAccessable);

        return $construct;
    }

    public function getMethod(string $name, ?bool $isAccessable = true): \ReflectionMethod
    {
        /** @var \ReflectionMethod $method */
        $method = $this->reflectedClass->getMethod($name);
        $isAccessable === null ? '' : $method->setAccessible($isAccessable);

        return $method;
    }

    public function getProperty(string $name, ?bool $isAccessable = true): \ReflectionProperty
    {
        $property = $this->reflectedClass->getProperty($name);
        $isAccessable === null ? '' : $property->setAccessible($isAccessable);

        return $property;
    }
}
