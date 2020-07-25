<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;

class VisitorOfIPropertyValueBinding extends VisitorOfT
{
    protected function VisitT($binding, array &$followup, array &$references): ?iterable
    {
        assert($binding instanceof IPropertyValueBinding);
        $errors = [];

        $followup[] = $binding->getValue();

        $references[] = $binding->getBoundProperty();

        return $errors;
    }

    public function forType(): string
    {
        return IPropertyValueBinding::class;
    }
}
