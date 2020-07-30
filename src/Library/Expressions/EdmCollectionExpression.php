<?php

declare(strict_types=1);

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
     * @param ITypeReference $declaredType declared type of the collection
     * @param IExpression    $elements     the constructed element values
     */
    public function __construct(ITypeReference $declaredType, IExpression ...$elements)
    {
        EdmUtil::checkArgumentNull($elements, 'elements');
        $this->declaredType = $declaredType;
        $this->elements     = $elements;
    }

    /**
     * {@inheritdoc}
     */
    public function getDeclaredType(): ITypeReference
    {
        return $this->declaredType;
    }

    /**
     * {@inheritdoc}
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::Collection();
    }
}
