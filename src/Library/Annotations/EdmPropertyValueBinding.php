<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Annotations;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents a property binding specified as part of an EDM type annotation.
 *
 * @package AlgoWeb\ODataMetadata\Library\Annotations
 */
class EdmPropertyValueBinding extends EdmElement implements IPropertyValueBinding
{
    /**
     * @var IProperty
     */
    private $boundProperty;
    /**
     * @var IExpression
     */
    private $value;

    /**
     * Initializes a new instance of the EdmPropertyValueBinding class.
     * @param IProperty   $boundProperty property that is given a value by the annotation
     * @param IExpression $value         expression producing the value of the annotation
     */
    public function __construct(IProperty $boundProperty, IExpression $value)
    {
        $this->boundProperty = $boundProperty;
        $this->value         = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getBoundProperty(): IProperty
    {
        return $this->boundProperty;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(): IExpression
    {
        return $this->value;
    }
}
