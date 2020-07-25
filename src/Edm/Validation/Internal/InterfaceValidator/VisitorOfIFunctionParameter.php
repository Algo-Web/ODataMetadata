<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;

class VisitorOfIFunctionParameter extends VisitorOfT
{
    protected function visitT($parameter, array &$followup, array &$references): ?iterable
    {
        assert($parameter instanceof IFunctionParameter);

        $errors = [];

        // Parameter owns its type reference, so it goes as a followup.
        $followup[] = $parameter->getType();

        $references[] = $parameter->getDeclaringFunction();

        if ($parameter->getMode()->getValue() < FunctionParameterMode::None()->getValue() ||
                    $parameter->getMode()->getValue() > FunctionParameterMode::InOut()->getValue()) {
            InterfaceValidator::collectErrors(
                InterfaceValidator::createEnumPropertyOutOfRangeError(
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
