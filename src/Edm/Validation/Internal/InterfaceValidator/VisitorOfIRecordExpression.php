<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;

class VisitorOfIRecordExpression extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IRecordExpression);
        $errors = [];

        InterfaceValidator::ProcessEnumerable($expression, $expression->getProperties(), 'Properties', $followup, $errors);

        if (null !== $expression->getDeclaredType()) {
            // Record constructor owns its type reference, so it goes as a followup.
            $followup[] = $expression->getDeclaredType();
        }

        return $errors;
    }

    public function forType(): string
    {
        return IRecordExpression::class;
    }
}
