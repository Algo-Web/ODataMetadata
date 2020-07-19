<?php


namespace AlgoWeb\ODataMetadata\Library\Expressions\RecordExpression;


use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM property constructor specified as part of a EDM record construction expression.
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmPropertyConstructor extends EdmElement implements IPropertyConstructor
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): IExpression
    {
        return $this->value;
    }
    /**
     * @var string
     */
    private $name;
    /**
     * @var IExpression
     */
        private $value;

    /**
     * Initializes a new instance of the EdmPropertyConstructor class.
     * @param string $name Property name.
     * @param IExpression $value Property value.
     */
    public function __construct(string $name, IExpression $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

}