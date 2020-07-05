<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEntitySetReferenceExpression;

class VisitorOfIEntitySetReferenceExpression extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IEntitySetReferenceExpression);
        if (null !== $expression->getReferencedEntitySet()) {
            $references[] = $expression->getReferencedEntitySet();
            return null;
        } else {
            return [ InterfaceValidator::CreatePropertyMustNotBeNullError($expression, 'ReferencedEntitySet') ];
        }
    }

    public function forType(): string
    {
        return IEntitySetReferenceExpression::class;
    }
}
