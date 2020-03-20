<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Constant;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * Class representing TStringConstantExpressionType.
 *
 * 16.1.9 The Edm:String Constant Expression
 *
 * The Edm:String constant expression evaluates to a primitive string value. A string expression MUST be assigned a
 * value of the type [xs:string][csdl19].
 *
 * A string expression may be written with either element notation or attribute notation, as shown in the following
 * examples:
 *
 *     <ValueAnnotation Term="org.example.display.DisplayName" String="Product Catalog" />
 *
 *     <ValueAnnotation Term="org.example.display.DisplayName">
 *         <String>Product Catalog</String>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.1.9
 * XSD Type: TStringConstantExpression
 */
class StringConstant extends ConstantBase
{
    /**
     * Construct.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value.
     *
     * @param  string $value
     * @return string
     */
    public function value(string $value = null): string
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
        return 'String';
    }
}
