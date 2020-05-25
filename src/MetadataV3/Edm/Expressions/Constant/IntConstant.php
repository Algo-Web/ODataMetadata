<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Constant;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * Class representing TIntConstantExpressionType.
 *
 * 16.1.8 The Edm:Int Constant Expression
 * The Edm:Int constant expression evaluates to a primitive integral value. An integral expression MUST be assigned a
 * value of the type [xs:integer][csdl19].
 *
 * An integral expression may be written with either element notation or attribute notation, as shown in the following
 * examples:
 *
 *     <ValueAnnotation Term="org.example.display.Width" Int="42" />
 *
 *     <ValueAnnotation Term="org.example.display.Width">
 *         <Int>42</Int>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.1.8
 * XSD Type: TIntConstantExpression
 */
class IntConstant extends ConstantBase
{
    /**
     * Construct.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value.
     *
     * @param  int $value
     * @return int
     */
    public function value(int $value = null): int
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
        return 'Int';
    }
}
