<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IValueTermReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM value term reference expression.
 *
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmValueTermReferenceExpression extends EdmElement implements IValueTermReferenceExpression
{

    /**
     * @var IExpression
     */
    private $baseExpression;
    /**
     * @var IValueTerm
     */
    private $term;
    /**
     * @var string
     */
    private $qualifier;

    /**
     * Initializes a new instance of the EdmValueTermReferenceExpression class.
     * @param IExpression $baseExpression expression for the structured value containing the referenced term property
     * @param IValueTerm  $term           referenced value term
     * @param string      $qualifier      Qualifier
     */
    public function __construct(IExpression $baseExpression, IValueTerm $term, string $qualifier = null)
    {
        $this->baseExpression = $baseExpression;
        $this->term           = $term;
        $this->qualifier      = $qualifier;
    }
    /**
     * {@inheritdoc}
     */
    public function getBase(): IExpression
    {
        return $this->baseExpression;
    }

    /**
     * {@inheritdoc}
     */
    public function getTerm(): IValueTerm
    {
        return $this->term;
    }

    /**
     * {@inheritdoc}
     */
    public function getQualifier(): string
    {
        return $this->qualifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::ValueTermReference();
    }
}
