<?php

declare(strict_types=1);


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
     * @param IEntitySet $referencedEntitySet referenced entity set
     */
    public function __construct(IEntitySet $referencedEntitySet)
    {
        $this->referencedEntitySet = $referencedEntitySet;
    }

    /**
     * {@inheritdoc}
     */
    public function getReferencedEntitySet(): IEntitySet
    {
        return $this->referencedEntitySet;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::EntitySetReference();
    }
}
