<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation;

use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use ReflectionFunction;
use ReflectionMethod;

/**
 * A semantic validation rule.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation
 */
abstract class ValidationRule
{
    private $validate;
    abstract function getValidatedType(): string;

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * Initializes a new instance of the ValidationRule class
     *
     * @param callable $validate Action to perform the validation.
     */
    public function __construct(callable $validate)
    {
        /** @noinspection PhpUnhandledExceptionInspection suppressing exceptions for asserts.*/
        assert(
            (is_array($validate) ? new ReflectionMethod(...$validate) : new ReflectionFunction($validate))->getParameters()[0]->getType()->getName() === ValidationContext::class
            , '$isBad should be a callable taking Two parameter the first being of Type ValidationContext');
        /** @noinspection PhpUnhandledExceptionInspection suppressing exceptions for asserts.*/
        assert(
            (is_array($validate) ? new ReflectionMethod(...$validate) : new ReflectionFunction($validate))->getParameters()[1]->getType()->getName() === $this->getValidatedType()
            , '$isBad should be a callable taking Two parameter the Second being of Type' . $this->getValidatedType());
        $this->validate = $validate;
    }

    public function Evaluate(ValidationContext $context, ?IEdmElement $item)
    {
        assert(is_a($item, $this->getValidatedType()), "item should be " . $this->getValidatedType());
        $validate = $this->validate;
        $validate($context, $item);
    }
}