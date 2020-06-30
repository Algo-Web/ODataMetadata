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
    protected function VisitT($value, array &$followup, array &$references): ?iterable
    {
        assert($value instanceof IValue);
        $errors = null;
        if (null !== $value->getType()) {
            // Value owns its type reference, so it goes as a followup.
            $followup[] = $value->getType();
        }

        switch ($value->getValueKind()) {
            case ValueKind::Binary():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        IBinaryValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::Boolean():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        IBooleanValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::Collection():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        ICollectionValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::DateTime():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        IDateTimeValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::DateTimeOffset():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        IDateTimeOffsetValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::Decimal():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        IDecimalValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::Enum():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        IEnumValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::Floating():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        IFloatingValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::Guid():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        IGuidValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::Integer():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        IIntegerValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::Null():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        INullValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::String():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        IStringValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::Structured():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        IStructuredValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::Time():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $value,
                        $value->getValueKind(),
                        'ValueKind',
                        ITimeValue::class
                    ),
                    $errors
                );
                break;

            case ValueKind::None():
                break;

            default:
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CreateInterfaceKindValueUnexpectedError(
                        $value,
                        $value->getValueKind()->getKey(),
                        'ValueKind'
                    ),
                    $errors
                );
                break;
        }

        return $errors;
    }

    public function forType(): string
    {
        return IValue::class;
    }
}
