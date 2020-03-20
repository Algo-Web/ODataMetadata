<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Annotations;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.33 PropertyValue.
 *
 * A PropertyValue element is used to assign the result of an expression to a property of a term.
 *
 * The following is an example of the PropertyValue element.
 *
 *     <TypeAnnotation Term="ContactInfo">
 *         <PropertyValue Property="ContactName" String="ContactName1" />
 *     </TypeAnnotation>
 *
 * The following rules apply to the PropertyValue element:
 * - A PropertyValue MUST have a Property attribute defined that is of type SimpleIdentifier. Property names the
 *   property for which the value is supplied.
 * - A PropertyValue can specify an expression as a child element or as an expression attribute that gives the value of
 *   the property.
 * - A PropertyValue can have one of the following expression attributes defined in place of a child element expression.
 *   Each of these is equivalent to the same-named expression with the equivalent spelling:
 * - - Path
 * - - String
 * - - Int
 * - - Float
 * - - Decimal
 * - - Bool
 * - - DateTime
 *
 * The edm:PropertyValue element supplies a value to a property on the type instantiated by a type annotation. The
 * value is obtained by evaluating an expression.
 *
 *     <PropertyValue Property="ContactName" String="ContactName1" />
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl15.3
 * XSD Type: TPropertyValue
 */
class PropertyValue extends EdmBase
{
    /**
     * @var string $property The property value element MUST assign a [simpleidentifier][csdl19] value to the
     *             edm:Property attribute. The value of the property attribute SHOULD resolve to a property on the term
     *             referenced by the type annotation.
     */
    private $property;
    /**
     * @var Expressions\ExpressionBase A property value MUST contain exactly one expression. The expression MAY be
     *                                 provided using element notation or attribute notation.
     */
    private $expression;

    /**
     * Gets as property.
     *
     * @return string
     */
    public function getProperty(): string
    {
        return $this->property;
    }

    /**
     * Sets a new property.
     *
     * @param  string $property
     * @return self
     */
    public function setProperty(string $property): self
    {
        $this->property = $property;
        return $this;
    }

    /**
     * Gets as expression.
     *
     * @return Expressions\ExpressionBase
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * Sets a new valueTermReference.
     *
     * @param  Expressions\ExpressionBase $expression
     * @return self
     */
    public function setExpression(Expressions\ExpressionBase $expression): self
    {
        $this->expression = $expression;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'PropertyValue';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        if (
            $this->expression instanceof Expressions\Dynamic\TPathExpression ||
            $this->expression instanceof Expressions\Constant\StringConstant ||
            $this->expression instanceof Expressions\Constant\IntConstant ||
            $this->expression instanceof Expressions\Constant\FloatConstant ||
            $this->expression instanceof Expressions\Constant\DecimalConstant ||
            $this->expression instanceof Expressions\Constant\BoolConstant ||
            $this->expression instanceof Expressions\Constant\DateTimeConstant
        ) {
            return [$this->expression];
        }
        return [];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        if (!(
            $this->expression instanceof Expressions\Dynamic\TPathExpression ||
            $this->expression instanceof Expressions\Constant\StringConstant ||
            $this->expression instanceof Expressions\Constant\IntConstant ||
            $this->expression instanceof Expressions\Constant\FloatConstant ||
            $this->expression instanceof Expressions\Constant\DecimalConstant ||
            $this->expression instanceof Expressions\Constant\BoolConstant ||
            $this->expression instanceof Expressions\Constant\DateTimeConstant
        )) {
            return [$this->expression];
        }
        return [];
    }
}
