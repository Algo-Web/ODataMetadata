<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpressionReferenceExpression;

class VisitorOfILabeledElementReferenceExpression extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): iterable
    {
        assert($expression instanceof ILabeledExpressionReferenceExpression);
        if ($expression->getReferencedLabeledExpression() != null) {
            $references[] = $expression->getReferencedLabeledExpression();
            return null;
        } else {
            return [
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression,
                    'ReferencedLabeledExpression'
                )
            ];
        }
    }

    public function forType(): string
    {
        return ILabeledExpressionReferenceExpression::class;
    }
}
