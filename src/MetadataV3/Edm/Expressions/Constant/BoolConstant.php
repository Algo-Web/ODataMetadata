<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Constant;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * Class representing TBoolConstantExpressionType
 *
 * 16.1.2 The Edm:Bool Constant Expression
 *
 * The Edm:Bool constant expression evaluates to a primitive boolean value.A boolean expression MUST be assigned a
 * value of the type [xs:boolean][csdl19].
 *
 * A boolean expression may be written with either element notation or attribute notation, as shown in the following
 * examples:
 *
 *     <ValueAnnotation Term="org.example.display.ReadOnly" Bool="true" />
 *
 *     <ValueAnnotation Term="org.example.display.ReadOnly">
 *         <Bool>true</Bool>
 *     </ValueAnnotation>
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.1.2
 * XSD Type: TBoolConstantExpression
 */
class BoolConstant extends ConstantBase
{
    /**
     * Construct
     *
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value
     *
     * @param bool $value
     * @return bool
     */
    public function value(bool $value = null): bool
    {
        if (null !== $value) {
            $this->__value = $value;
        }
        return $this->__value;
    }

    /**
     * Gets a string value
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->__value ? "true" : "false";
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Bool';
    }
}
