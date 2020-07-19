<?php


namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ICollectionExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM multi-value construction expression.
 *
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmCollectionExpression extends EdmElement implements ICollectionExpression
{
    /**
     * @var ITypeReference
     */
    private $declaredType;
    /**
     * @var IExpression[]
     */
    private $elements;

    /**
     * Initializes a new instance of the EdmCollectionExpression class.
     * @param ITypeReference $declaredType Declared type of the collection.
     * @param IExpression[] $elements The constructed element values.
     */
    public function __construct(ITypeReference $declaredType, IExpression ...$elements)
    {
        EdmUtil::CheckArgumentNull($elements, "elements");
        $this->declaredType = $declaredType;
        $this->elements = $elements;
    }

    /**
     * @inheritDoc
     */
    public function getDeclaredType(): ITypeReference
    {
        return $this->declaredType;
    }

    /**
     * @inheritDoc
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    /**
     * @inheritDoc
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::Collection();
    }
}