<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata;

use AlgoWeb\ODataMetadata\Exception\ArgumentException;
use ReflectionException;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use ReflectionNamedType;

abstract class Asserts
{
    private static function performAsserts(): bool
    {
        return assert_options(ASSERT_ACTIVE) === 1;
    }

    public static function assertSignatureMatches(callable $expected, callable $actual, string $callablePropName): bool
    {
        if (!self::performAsserts()) {
            return true;
        }
        $expectedReflection = self::getReflection($expected);
        $actualReflection   = self::getReflection($actual);
        $messageBuilder     = function (string $messagePrefix = '') use ($callablePropName, $expectedReflection, $actualReflection): string {
            return sprintf(
                '%s%s should be a callable with signature %s, however callable with signature %s provided',
                empty($messagePrefix) ? $messagePrefix : trim($messagePrefix) . ' ',
                $callablePropName,
                self::getSignatureFromReflection($expectedReflection),
                self::getSignatureFromReflection($actualReflection)
            );
        };
        assert(
            $expectedReflection->getNumberOfRequiredParameters() ===  $actualReflection->getNumberOfRequiredParameters(),
            $messageBuilder('Incorrect Parameter Count')
        );
        if ($expectedReflection->hasReturnType()) {
            assert(
                $actualReflection->hasReturnType(),
                $messageBuilder('Missing Return Type')
            );
            //TODO: improve this to check that the actual type does not return a childType;
            $expectedReturnType = $expectedReflection->getReturnType();
            $actualReturnType   = $actualReflection->getReturnType();
            $name               = $expectedReturnType instanceof ReflectionNamedType ?
                $expectedReturnType->getName() :
                strval($expectedReturnType);
            $actName = $actualReturnType instanceof ReflectionNamedType ?
                $actualReturnType->getName() :
                strval($actualReturnType);

            assert(
                $name === $actName,
                $messageBuilder('IncorrectOrInvalid ReturnType')
            );
            if (!$expectedReturnType->allowsNull()) {
                assert(
                    !$actualReturnType->allowsNull(),
                    $messageBuilder('Nullable ReturnType Not allowed')
                );
            }
        }

        for ($i = 0; $i < $expectedReflection->getNumberOfParameters(); $i++) {
            $expectedParm = $expectedReflection->getParameters()[$i];
            if ($expectedParm->hasType()) {
                $actualParm = $actualReflection->getParameters()[$i];
                assert(
                    $actualParm->hasType(),
                    $messageBuilder(sprintf('Parameter %s Is missing TypeHint', $i))
                );
                $expectedParmType = $expectedParm->getType();
                $actualParmType   = $actualParm->getType();
                $name             = $expectedParmType instanceof ReflectionNamedType ?
                    $expectedParmType->getName() :
                    strval($expectedParmType);
                $actName = $actualParmType instanceof ReflectionNamedType ?
                    $actualParmType->getName() :
                    strval($actualParmType);

                //TODO: improve this to check that the actual type does not return a childType;
                assert(
                    $name === $actName,
                    $messageBuilder(sprintf('Parameter %s has Incorrect Type', $i))
                );
                if (!$expectedParm->allowsNull()) {
                    assert(
                        !$actualParm->allowsNull(),
                        $messageBuilder(sprintf('Parameter %s should disallow Nulls', $i))
                    );
                }
            }
        }
        return true;
    }

    private static function getSignatureFromReflection(ReflectionFunctionAbstract $reflection): string
    {
        $parameters = [];
        foreach ($reflection->getParameters() as $parameter) {
            $parameterString = '';
            if ($parameter->hasType()) {
                $parmType        = $parameter->getType();
                $parmName        = $parmType instanceof ReflectionNamedType ?
                                    $parmType->getName() :
                                    strval($parmType);
                $parameterString .= $parmType->allowsNull() ? '?' : '';
                $parameterString .= $parmName . ' ';
            }
            $parameterString .= $parameter->isVariadic() ? '...$' : '$';
            $parameterString .= $parameter->getName();
            if ($parameter->isOptional()) {
                try {
                    $parameterString .= ' = ' . strval($parameter->getDefaultValue());
                } catch (ReflectionException $e) {
                    // Keep on trucking
                }
            }
            $parameters[] = $parameterString;
        }
        $return = '';
        if ($reflection->hasReturnType()) {
            $returnType = $reflection->getReturnType();
            $name       = $returnType instanceof ReflectionNamedType ?
                $returnType->getName() :
                strval($returnType);
            $return .= ': ' . $name;
        }
        return sprintf('function(%s)%s', implode(',', $parameters), $return);
    }

    private static function getReflection(callable $method): ReflectionFunctionAbstract
    {
        try {
            return is_array($method) ? new ReflectionMethod(...$method) : new ReflectionFunction($method);
        } catch (ReflectionException $e) {
            throw new ArgumentException($e->getMessage());
        }
    }
}
