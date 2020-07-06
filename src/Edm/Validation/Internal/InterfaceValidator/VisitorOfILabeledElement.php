<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpression;

class VisitorOfILabeledElement extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof ILabeledExpression);
        $followup[] = $expression->getExpressionKind();
        return null;
    }

    public function forType(): string
    {
        return ILabeledExpression::class;
    }
}
