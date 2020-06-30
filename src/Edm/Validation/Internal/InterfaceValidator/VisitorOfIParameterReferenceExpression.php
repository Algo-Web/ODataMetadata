<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IParameterReferenceExpression;

class VisitorOfIParameterReferenceExpression extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): iterable
    {
        assert($expression instanceof IParameterReferenceExpression);
        if ($expression->getReferencedParameter() != null) {
            $references[] = $expression->getReferencedParameter();
            return null;
        } else {
            return [ InterfaceValidator::CreatePropertyMustNotBeNullError($expression, 'ReferencedParameter') ];
        }
    }

    public function forType(): string
    {
        return IParameterReferenceExpression::class;
    }
}
