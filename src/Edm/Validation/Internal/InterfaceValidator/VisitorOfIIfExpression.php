<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;

class VisitorOfIIfExpression extends VisitorOfT
{

    protected function VisitT($expression, array &$followup, array &$references): iterable
    {
        assert($expression instanceof IIfExpression);
        $errors = null;

        if ($expression->getTestExpression() != null)
        {
            $followup[] = $expression->getTestExpression();
        }
        else
        {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression,
                    "TestExpression"
                ),
                $errors
            );
        }

        if ($expression->getTrueExpression() != null)
        {
            $followup[] = $expression->getTrueExpression();
        }
        else
        {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression,
                    "TrueExpression"
                ),
                $errors
            );
        }

        if ($expression->getFalseExpression() != null)
        {
            $followup[] = $expression->getFalseExpression();
        }
        else
        {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression, "FalseExpression"
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IIfExpression::class;
    }
}