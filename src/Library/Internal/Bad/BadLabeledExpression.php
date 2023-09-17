<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Internal\Cache;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpression;
use AlgoWeb\ODataMetadata\Library\Values\EdmNullExpression;

class BadLabeledExpression extends BadElement implements ILabeledExpression
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var Cache
     */
    private $expressionCache;

    public function __construct(?string $name, array $errors)
    {
        parent::__construct($errors);
        $this->expressionCache = new Cache(BadLabeledExpression::class, IExpression::class);
        $this->name            = $name ?? '';
    }

    /**
     * @return ExpressionKind gets the kind of this expression
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::Labeled();
    }

    /**
     * @return IExpression gets the underlying expression
     */
    public function getExpression(): IExpression
    {
        $expression = $this->expressionCache->getValue($this, [$this, 'computeExpression']);
        assert($expression instanceof IExpression);
        return $expression;
    }

    /**
     * @return string|null gets the name of this element
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    private function computeExpression(): IExpression
    {
        return EdmNullExpression::getInstance();
    }
}
