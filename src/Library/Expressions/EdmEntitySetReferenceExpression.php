<?php


namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEntitySetReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM entity set reference expression.
 *
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmEntitySetReferenceExpression extends EdmElement implements IEntitySetReferenceExpression
{
    /**
     * @var IEntitySet
     */
    private $referencedEntitySet;

    /**
     * Initializes a new instance of the EdmEntitySetReferenceExpression class.
     * @param IEntitySet $referencedEntitySet Referenced entity set.
     */
    public function __construct(IEntitySet $referencedEntitySet)
    {
        $this->referencedEntitySet = $referencedEntitySet;
    }

    /**
     * @inheritDoc
     */
    public function getReferencedEntitySet(): IEntitySet
    {
        return $this->referencedEntitySet;
    }

    /**
     * @inheritDoc
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::EntitySetReference();
    }
}