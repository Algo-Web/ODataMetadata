<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;


use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;

/**
 * Interface IEntitySetReferenceExpression
 *
 * Represents an EDM entity set reference expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IEntitySetReferenceExpression extends IExpression
{
    /**
     * @return IEntitySet Gets the referenced entity set.
     */
    public function getReferencedEntitySet(): IEntitySet;
}