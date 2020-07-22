<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Helpers\ValueHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Library\Values\EdmValue;

class EdmNullExpression extends EdmValue implements INullExpression
{
    use ValueHelpers;
    private static $instance = null;

    /**
     * @return EdmNullExpression singleton EdmNullExpression instance
     */
    public static function getEdmNullExpression(): EdmNullExpression
    {
        return self::$instance ?? self::$instance = new self();
    }

    public function __construct()
    {
        parent::__construct(null);
    }

    /**
     * {@inheritdoc}
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Null();
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::Null();
    }
}
