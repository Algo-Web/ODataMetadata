<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEnumMemberReferenceExpression;

class VisitorOfIEnumMemberReferenceExpression extends VisitorOfT
{

    protected function VisitT($expression, array &$followup, array &$references): iterable
    {
        assert($expression instanceof IEnumMemberReferenceExpression);
        if ($expression->getReferencedEnumMember() != null)
        {
            $references[] = $expression->getReferencedEnumMember();
            return null;
        }
        else
        {
            return [ InterfaceValidator::CreatePropertyMustNotBeNullError($expression, "ReferencedEnumMember") ];
        }
    }

    public function forType(): string
    {
        return IEnumMemberReferenceExpression::class;
    }
}