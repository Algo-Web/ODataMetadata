<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Constant;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * Class representing TFloatConstantExpressionType.
 *
 * 16.1.6 The Edm:Float Constant Expression
 *
 * The Edm:Float constant expression evaluates to a primitive floating point (or double) value. A floating point
 * expression MUST be assigned a value of the type [xs:double][csdl19].
 *
 * A floating point expression may be written with either element notation or attribute notation, as shown in the
 * following examples:
 *     <ValueAnnotation Term="org.example.display.Width" Float="3.14" />
 *
 *     <ValueAnnotation Term="org.example.display.Width">
 *         <Float>3.14</Float>
 * </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.1.6
 * XSD Type: TFloatConstantExpression
 */
class FloatConstant extends ConstantBase
{
    /**
     * Construct.
     *
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value.
     *
     * @param  float $value
     * @return float
     */
    public function value(float $value = null): float
    {
        if (null !== $value) {
            $this->__value = $value;
        }
        return $this->__value;
    }


    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Float';
    }
}
