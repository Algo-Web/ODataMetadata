<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;

class VisitorOfIValueAnnotation extends VisitorOfT
{
    protected function visitT($annotation, array &$followup, array &$references): ?iterable
    {
        assert($annotation instanceof IValueAnnotation);
        $followup[] = $annotation->getValue();
        return null;
    }

    public function forType(): string
    {
        return IValueAnnotation::class;
    }
}
