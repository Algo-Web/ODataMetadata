<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IAssertTypeExpression;

class VisitorOfIAssertTypeExpression extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IAssertTypeExpression);
        $errors = [];

        $followup[] = $expression->getOperand();

        // Assert owns its type reference, so it goes as a followup.
        $followup[] = $expression->getType();

        return $errors;
    }

    public function forType(): string
    {
        return IAssertTypeExpression::class;
    }
}
