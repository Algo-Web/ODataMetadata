<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\Values\IBinaryValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IBooleanValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\ICollectionValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDateTimeOffsetValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDateTimeValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDecimalValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IEnumValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IFloatingValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IGuidValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IIntegerValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\INullValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStringValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStructuredValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\ITimeValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IValue;

class VisitorOfIValue extends VisitorOfT
{
    protected $lookup = [];

    public function __construct()
    {
        $this->lookup[ValueKind::Binary()->getValue()]         = IBinaryValue::class;
        $this->lookup[ValueKind::Boolean()->getValue()]        = IBooleanValue::class;
        $this->lookup[ValueKind::Collection()->getValue()]     = ICollectionValue::class;
        $this->lookup[ValueKind::DateTime()->getValue()]       = IDateTimeValue::class;
        $this->lookup[ValueKind::DateTimeOffset()->getValue()] = IDateTimeOffsetValue::class;
        $this->lookup[ValueKind::Decimal()->getValue()]        = IDecimalValue::class;
        $this->lookup[ValueKind::Enum()->getValue()]           = IEnumValue::class;
        $this->lookup[ValueKind::Floating()->getValue()]       = IFloatingValue::class;
        $this->lookup[ValueKind::Guid()->getValue()]           = IGuidValue::class;
        $this->lookup[ValueKind::Integer()->getValue()]        = IIntegerValue::class;
        $this->lookup[ValueKind::Null()->getValue()]           = INullValue::class;
        $this->lookup[ValueKind::String()->getValue()]         = IStringValue::class;
        $this->lookup[ValueKind::Structured()->getValue()]     = IStructuredValue::class;
        $this->lookup[ValueKind::Time()->getValue()]           = ITimeValue::class;
    }

    protected function visitT($value, array &$followup, array &$references): ?iterable
    {
        assert($value instanceof IValue);
        $errors = [];
        if (null !== $value->getType()) {
            // Value owns its type reference, so it goes as a followup.
            $followup[] = $value->getType();
        }

        $kind = $value->getValueKind();
        if (ValueKind::None()->getValue() === $kind->getValue()) {
            return $errors;
        }

        if (!array_key_exists($kind->getValue(), $this->lookup)) {
            InterfaceValidator::collectErrors(
                InterfaceValidator::createInterfaceKindValueUnexpectedError(
                    $value,
                    $value->getValueKind()->getKey(),
                    'ValueKind'
                ),
                $errors
            );

            return $errors;
        }

        InterfaceValidator::collectErrors(
            InterfaceValidator::checkForInterfaceKindValueMismatchError(
                $value,
                $value->getValueKind(),
                'ValueKind',
                $this->lookup[$kind->getValue()]
            ),
            $errors
        );
        return $errors;
    }

    public function forType(): string
    {
        return IValue::class;
    }
}
