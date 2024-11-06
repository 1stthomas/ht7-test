<?php

namespace Ht7\Test\Reflection;

class ReflectionHelper
{
    public readonly \ReflectionClass $reflectedClass;
    public function __construct(string|\ReflectionClass $class)
    {
        $this->reflectedClass = is_string($class) ? new \ReflectionClass($class) : $class;
    }
    public function getConstructor(?bool $isAccessable = true): \ReflectionMethod
    {
        $construct = $this->reflectedClass->getConstructor();
        $isAccessable === null ? '' : $construct->setAccessible($isAccessable);

        return $construct;
    }
    public function getMethod(string $name, ?bool $isAccessable = true): \ReflectionMethod
    {
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
