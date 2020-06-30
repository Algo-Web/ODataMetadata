<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;

class VisitorOfIValueAnnotation extends VisitorOfT
{
    protected function VisitT($annotation, array &$followup, array &$references): ?iterable
    {
        assert($annotation instanceof IValueAnnotation);
        if (null !== $annotation->getValue()) {
            $followup[] = $annotation->getValue();
            return null;
        } else {
            return [InterfaceValidator::CreatePropertyMustNotBeNullError($annotation, 'Value') ];
        }
    }

    public function forType(): string
    {
        return IValueAnnotation::class;
    }
}
