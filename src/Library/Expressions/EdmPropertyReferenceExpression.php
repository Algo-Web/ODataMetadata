<?php


namespace AlgoWeb\ODataMetadata\Library\Expressions;


use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPropertyReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM property reference expression.
 *
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmPropertyReferenceExpression extends EdmElement implements IPropertyReferenceExpression
{

    /**
     * @var IExpression
     */
    private $baseExpression;
    /**
     * @var IProperty
     */
    private $referencedProperty;

    /**
     * Initializes a new instance of the EdmPropertyReferenceExpression class.
     * @param IExpression $baseExpression Expression for the structured value containing the referenced property.
     * @param IProperty $referencedProperty Referenced property.
     */
    public function __construct(IExpression $baseExpression, IProperty $referencedProperty)
    {
        $this->baseExpression = $baseExpression;
        $this->referencedProperty = $referencedProperty;
    }

    /**
     * @return IProperty
     */
    public function getReferencedProperty(): IProperty
    {
        return $this->referencedProperty;
    }

    /**
     * @inheritDoc
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::PropertyReference();
    }

    /**
     * @inheritDoc
     */
    public function getBase(): IExpression
    {
        return $this->baseExpression;
    }
}