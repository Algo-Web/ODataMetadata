<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ICollectionExpression;

class VisitorOfICollectionExpression extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof ICollectionExpression);
        $errors = [];

        InterfaceValidator::ProcessEnumerable($expression, $expression->getElements(), 'Elements', $followup, $errors);

        if (null !== $expression->getDeclaredType()) {
            // Collection constructor owns its type reference, so it goes as a followup.
            $followup[] = $expression->getDeclaredType();
        }

        return $errors;
    }

    public function forType(): string
    {
        return ICollectionExpression::class;
    }
}
