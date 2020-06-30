<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;

class VisitorOfIDirectValueAnnotation extends VisitorOfT
{
    protected function VisitT($annotation, array &$followup, array &$references): iterable
    {
        assert($annotation instanceof IDirectValueAnnotation);
        $errors = null;

        if ($annotation->getNamespaceUri() == null) {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $annotation,
                    'NamespaceUri'
                ),
                $errors
            );
        }

        if ($annotation->getValue() == null) {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
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
