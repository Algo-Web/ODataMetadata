<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;

class VisitorOfIDirectValueAnnotation extends VisitorOfT
{
    protected function visitT($annotation, array &$followup, array &$references): ?iterable
    {
        assert($annotation instanceof IDirectValueAnnotation);
        $errors = [];

        if (empty($annotation->getNamespaceUri())) {
            InterfaceValidator::collectErrors(
                InterfaceValidator::createPropertyMustNotBeNullError(
                    $annotation,
                    'NamespaceUri'
                ),
                $errors
            );
        }

        if (null === $annotation->getValue()) {
            InterfaceValidator::collectErrors(
                InterfaceValidator::createPropertyMustNotBeNullError(
                    $annotation,
                    'Value'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IDirectValueAnnotation::class;
    }
}
