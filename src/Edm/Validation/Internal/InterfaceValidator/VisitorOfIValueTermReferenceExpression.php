<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IValueTermReferenceExpression;

class VisitorOfIValueTermReferenceExpression extends VisitorOfT
{

    protected function VisitT($expression, array &$followup, array &$references): iterable
    {
        assert($expression instanceof IValueTermReferenceExpression);
        $errors = null;

                if ($expression->getBase() != null)
                {
                    $followup[] = $expression->getBase();
                }
                else
                {
                    InterfaceValidator::CollectErrors(
                        InterfaceValidator::CreatePropertyMustNotBeNullError(
                            $expression,
                            "Base"
                        ),
                        $errors
                    );
                }

                if ($expression->getTerm() != null)
                {
                    $references[] = $expression->getTerm();
                }
                else
                {
                    InterfaceValidator::CollectErrors(
                        InterfaceValidator::CreatePropertyMustNotBeNullError(
                            $expression,
                            "Term"
                        ),
                        $errors
                    );
                }

                return $errors;
    }

    public function forType(): string
    {
        return IValueTermReferenceExpression::class;
    }
}