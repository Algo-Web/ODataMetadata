<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;

class VisitorOfIVocabularyAnnotation extends VisitorOfT
{
    protected function visitT($annotation, array &$followup, array &$references): ?iterable
    {
        assert($annotation instanceof IVocabularyAnnotation);
        $errors = [];

        if (null !== $annotation->getTerm()) {
            $references[] = $annotation->getTerm();
        } else {
            InterfaceValidator::collectErrors(
                InterfaceValidator::createPropertyMustNotBeNullError(
                    $annotation,
                    'Term'
                ),
                $errors
            );
        }

        if (null !== $annotation->getTarget()) {
            $references[] = $annotation->getTarget();
        } else {
            InterfaceValidator::collectErrors(
                InterfaceValidator::createPropertyMustNotBeNullError(
                    $annotation,
                    'Target'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IVocabularyAnnotation::class;
    }
}
