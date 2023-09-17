<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIsTypeExpression;

class VisitorOfIIsTypeExpression extends VisitorOfT
{
    protected function visitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IIsTypeExpression);
        $errors = [];

        $followup[] = $expression->getOperand();

        // Assert owns its type reference, so it goes as a followup.
        $followup[] = $expression->getType();

        return $errors;
    }

    public function forType(): string
    {
        return IIsTypeExpression::class;
    }
}
