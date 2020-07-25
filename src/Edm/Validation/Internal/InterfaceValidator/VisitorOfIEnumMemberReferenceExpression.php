<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEnumMemberReferenceExpression;

class VisitorOfIEnumMemberReferenceExpression extends VisitorOfT
{
    protected function visitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IEnumMemberReferenceExpression);
        $references[] = $expression->getReferencedEnumMember();
        return null;
    }

    public function forType(): string
    {
        return IEnumMemberReferenceExpression::class;
    }
}
