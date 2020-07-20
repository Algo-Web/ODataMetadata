<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFunctionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM function reference expression.
 *
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmFunctionReferenceExpression extends EdmElement implements IFunctionReferenceExpression
{
    /**
     * @var IFunction
     */
    private $referencedFunction;

    /**
     * Initializes a new instance of the EdmFunctionReferenceExpression class.
     * @param IFunction $referencedFunction Referenced function
     */
    public function __construct(IFunction $referencedFunction)
    {
        $this->referencedFunction = $referencedFunction;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::FunctionReference();
    }

    /**
     * {@inheritdoc}
     */
    public function getReferencedFunction(): IFunction
    {
        return $this->referencedFunction;
    }
}
