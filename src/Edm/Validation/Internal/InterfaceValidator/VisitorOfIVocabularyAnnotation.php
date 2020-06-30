<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;

class VisitorOfIVocabularyAnnotation extends VisitorOfT
{
    protected function VisitT($annotation, array &$followup, array &$references): ?iterable
    {
        assert($annotation instanceof IVocabularyAnnotation);
        $errors = null;

        if (null !== $annotation->getTerm()) {
            $references[] = $annotation->getTerm();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $annotation,
                    'Term'
                ),
                $errors
            );
        }

        if (null !== $annotation->getTarget()) {
            $references[] = $annotation->getTarget();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
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
