<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;

class VisitorOfIValueTerm extends VisitorOfT
{
    protected function visitT($term, array &$followup, array &$references): ?iterable
    {
        assert($term instanceof IValueTerm);
        if (null !== $term->getType()) {
            // Value term owns its element type reference, so it goes as a followup.
            $followup[] = $term->getType();
            return null;
        } else {
            return [InterfaceValidator::createPropertyMustNotBeNullError($term, 'Type')];
        }
    }

    public function forType(): string
    {
        return IValueTerm::class;
    }
}
