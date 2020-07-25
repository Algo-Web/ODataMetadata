<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpressionReferenceExpression;

class VisitorOfILabeledElementReferenceExpression extends VisitorOfT
{
    protected function visitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof ILabeledExpressionReferenceExpression);
        $references[] = $expression->getReferencedLabeledExpression();
        return null;
    }

    public function forType(): string
    {
        return ILabeledExpressionReferenceExpression::class;
    }
}
