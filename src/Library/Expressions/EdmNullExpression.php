<?php


namespace AlgoWeb\ODataMetadata\Library\Expressions;


use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Library\Values\EdmValue;

class EdmNullExpression extends EdmValue implements INullExpression
{
    private static $instance = null;

    /**
     * @return EdmNullExpression Singleton EdmNullExpression instance.
     */
    public static function getEdmNullExpression(): EdmNullExpression{
        return self::$instance ?? self::$instance = new self();
    }

    public function __construct()
    {
        parent::__construct(null);
    }

    /**
     * @inheritDoc
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Null();
    }

    /**
     * @inheritDoc
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::Null();
    }
}