<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpression;

class VisitorOfILabeledElement extends VisitorOfT
{

    protected function VisitT($expression, array &$followup, array &$references): iterable
    {
        assert($expression instanceof ILabeledExpression);
        if ($expression->getExpressionKind() != null)
        {
            $followup[] = $expression->getExpressionKind();
            return null;
        }
        else
        {
            return [InterfaceValidator::CreatePropertyMustNotBeNullError($expression, "Expression") ];
        }
    }

    public function forType(): string
    {
        return ILabeledExpression::class;
    }
}