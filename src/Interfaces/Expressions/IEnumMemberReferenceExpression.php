<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;


use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;

/**
 * Interface IEnumMemberReferenceExpression
 *
 * Represents an EDM enumeration member reference expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IEnumMemberReferenceExpression extends IExpression
{
    /**
     * @return IEnumMember Gets the referenced enum member.
     */
    public function getReferencedEnumMember(): IEnumMember;
}