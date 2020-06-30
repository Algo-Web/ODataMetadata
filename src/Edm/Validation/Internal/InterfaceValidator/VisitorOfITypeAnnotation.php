<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;

class VisitorOfITypeAnnotation extends VisitorOfT
{
    protected function VisitT($annotation, array &$followup, array &$references): iterable
    {
        assert($annotation instanceof ITypeAnnotation);
        $errors = null;
        InterfaceValidator::ProcessEnumerable(
            $annotation,
            $annotation->getPropertyValueBindings(),
            'PropertyValueBindings',
            $followup,
            $errors
        );
        return $errors;
    }

    public function forType(): string
    {
        return ITypeAnnotation::class;
    }
}
