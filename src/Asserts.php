<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata;

use AlgoWeb\ODataMetadata\Exception\ArgumentException;
use ReflectionException;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;

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
            assert(
                $expectedReflection->getReturnType()->getName() === $actualReflection->getReturnType()->getName(),
                $messageBuilder('IncorrectOrInvalid ReturnType')
            );
            if (!$expectedReflection->getReturnType()->allowsNull()) {
                assert(
                    !$actualReflection->getReturnType()->allowsNull(),
                    $messageBuilder('Nullable ReturnType Not allowed')
                );
            }
        }

        for ($i = 0; $i < $expectedReflection->getNumberOfParameters(); $i++) {
            if ($expectedReflection->getParameters()[$i]->hasType()) {
                assert(
                    $actualReflection->getParameters()[$i]->hasType(),
                    $messageBuilder(sprintf('Parameter %s Is missing TypeHint', $i))
                );
                //TODO: improve this to check that the actual type does not return a childType;
                assert(
                    $expectedReflection->getParameters()[$i]->getType()->getName() === $actualReflection->getParameters()[$i]->getType()->getName(),
                    $messageBuilder(sprintf('Parameter %s has Incorrect Type', $i))
                );
                if (!$expectedReflection->getParameters()[$i]->allowsNull()) {
                    assert(
                        !$actualReflection->getParameters()[$i]->allowsNull(),
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
                $parameterString .= $parameter->getType()->allowsNull() ? '?' : '';
                $parameterString .=$parameter->getType()->getName() . ' ';
            }
            $parameterString .= $parameter->isVariadic() ? '...$' : '$';
            $parameterString .= $parameter->getName();
            if ($parameter->isOptional()) {
                try {
                    $parameterString .= ' = ' . strval($parameter->getDefaultValue());
                } catch (ReflectionException $e) {
                }
            }
            $parameters[] = $parameterString;
        }
        $return = '';
        if ($reflection->hasReturnType()) {
            $return .= ': ' . $reflection->getReturnType()->getName();
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
