<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IApplyExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM function application expression.
 *
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmApplyExpression extends EdmElement implements IApplyExpression
{
    /**
     * @var IExpression|EdmFunctionReferenceExpression
     */
    private $appliedFunction;
    /**
     * @var IExpression[]
     */
    private $arguments;

    /**
     * Initializes a new instance of the EdmApplyExpression class.
     * @param IFunction|IExpression $appliedFunction function to apply
     * @param IExpression           ...$arguments    Application arguments. Value may be null, in which case it is treated as an empty enumerable.
     */
    public function __construct($appliedFunction, IExpression ...$arguments)
    {
        assert($appliedFunction instanceof IFunction || $appliedFunction instanceof IExpression);
        if ($appliedFunction instanceof IFunction) {
            $appliedFunction = new EdmFunctionReferenceExpression(EdmUtil::CheckArgumentNull($appliedFunction, 'appliedFunction'));
        }
        assert($appliedFunction instanceof IExpression);
        EdmUtil::CheckArgumentNull($appliedFunction, 'appliedFunction');
        EdmUtil::CheckArgumentNull($arguments, 'arguments');

        $this->appliedFunction = $appliedFunction;
        $this->arguments       = $arguments;
    }

    /**
     * {@inheritdoc}
     */
    public function getAppliedFunction(): ?IExpression
    {
        return $this->appliedFunction;
    }

    /**
     * {@inheritdoc}
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::FunctionApplication();
    }
}
