<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEntitySetReferenceExpression;

class VisitorOfIEntitySetReferenceExpression extends VisitorOfT
{
    protected function visitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IEntitySetReferenceExpression);
        $references[] = $expression->getReferencedEntitySet();
        return null;
    }

    public function forType(): string
    {
        return IEntitySetReferenceExpression::class;
    }
}
