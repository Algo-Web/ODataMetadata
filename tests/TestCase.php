<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $object
     * @param $methodName
     * @param mixed ...$args
     * @return mixed
     * @throws \ReflectionException
     */
    public function callPrivateMethod($object, $methodName, ...$args)
    {
        $reflectionClass = new \ReflectionClass($object);
        $reflectionMethod = $reflectionClass->getMethod($methodName);
        $reflectionMethod->setAccessible(true);

        //$params = array_slice(func_get_args(), 2); //get all the parameters after $methodName
        return $reflectionMethod->invokeArgs($object, $args);
    }

    public function getPrivateProperty($object, $propertyName)
    {
        $closure = \Closure::bind(function ($class) use ($propertyName) {
            return $class->propertyName;
        }, null, get_class($object));
        return $closure($object);
    }

    public function setPrivateProperty($object, $propertyName, $newValue)
    {
        $closure = \Closure::bind(function ($class) use ($propertyName) {
            return $class->$propertyName;
        }, null, get_class($object));
        $propertyValue = &$closure($object);
        $propertyValue = $newValue;
    }
}
