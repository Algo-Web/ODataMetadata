<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;

class VisitorOfIFunctionParameter extends VisitorOfT
{
    protected function VisitT($parameter, array &$followup, array &$references): iterable
    {
        assert($parameter instanceof IFunctionParameter);

        $errors = null;

        if ($parameter->getType() != null) {
            // Parameter owns its type reference, so it goes as a followup.
            $followup[] = $parameter->getType();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                            $parameter,
                            'Type'
                        ),
                $errors
            );
        }

        if ($parameter->getDeclaringFunction() != null) {
            $references[] = $parameter->getDeclaringFunction();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                            $parameter,
                            'DeclaringFunction'
                        ),
                $errors
            );
        }

        if ($parameter->getMode()->getValue() < FunctionParameterMode::None()->getValue() ||
                    $parameter->getMode()->getValue() > FunctionParameterMode::InOut()->getValue()) {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreateEnumPropertyOutOfRangeError(
                            $parameter,
                            $parameter->getMode(),
                            'Mode'
                        ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IFunctionParameter::class;
    }
}
