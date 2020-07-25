<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IParameterReferenceExpression;

class VisitorOfIParameterReferenceExpression extends VisitorOfT
{
    protected function visitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IParameterReferenceExpression);
        if (null !== $expression->getReferencedParameter()) {
            $references[] = $expression->getReferencedParameter();
            return null;
        } else {
            return [ InterfaceValidator::createPropertyMustNotBeNullError($expression, 'ReferencedParameter') ];
        }
    }

    public function forType(): string
    {
        return IParameterReferenceExpression::class;
    }
}
