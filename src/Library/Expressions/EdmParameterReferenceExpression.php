<?php


namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IParameterReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM parameter reference expression.
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmParameterReferenceExpression extends EdmElement implements IParameterReferenceExpression
{
    /**
     * @var IFunctionParameter
     */
    private $referencedParameter;

    /**
     * Initializes a new instance of the EdmParameterReferenceExpression class.
     * @param IFunctionParameter $referencedParameter Referenced parameter
     */
    public function __construct(IFunctionParameter $referencedParameter)
    {
        $this->referencedParameter = $referencedParameter;
    }

    /**
     * @inheritDoc
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::ParameterReference();
    }

    /**
     * @inheritDoc
     */
    public function getReferencedParameter(): ?IFunctionParameter
    {
        return $this->referencedParameter;
    }
}