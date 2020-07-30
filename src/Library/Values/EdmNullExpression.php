<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Helpers\ValueHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Interfaces\Values\IValue;
use InvalidArgumentException;

class EdmNullExpression extends EdmValue implements INullExpression
{
    use ValueHelpers;
    private static $instance       = null;
    private static $allowConstruct = false;
    /**
     * Singleton EdmNullExpression instance.
     *
     * @return EdmNullExpression|null
     */
    public static function getInstance()
    {
        self::$allowConstruct = true;
        self::$instance       = self::$instance ?? new EdmNullExpression();
        self::$allowConstruct = false;
        return self::$instance;
    }
    public function __construct()
    {
        if (!self::$allowConstruct) {
            throw new InvalidArgumentException(
                'Illegal construction of ' . self::class
            );
        }
        parent::__construct(null);
    }

    /**
     * @return ExpressionKind gets the kind of this expression
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::Null();
    }

    /**
     * @return ValueKind gets the kind of this value
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Null();
    }

    /**
     * @return null gets the data stored in this value
     */
    public function getValue()
    {
        return null;
    }
}
