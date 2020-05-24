<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Constant;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use InvalidArgumentException;

/**
 * 16.1.1 The Edm:Binary Constant Expression
 *
 * The Edm:Binary constant expression evaluates to a primitive binary value.A binary expression MUST be assigned a
 * value of the type [xs:hexbinary][csdl19].
 *
 * A binary expression may be written with either element notation or attribute notation, as shown in the following
 * examples:
 *     <ValueAnnotation Term="org.example.display.Thumbnail" Binary="3f3c6d78206c" />
 *
 *     <ValueAnnotation Term="org.example.display.Thumbnail">
 *         <Binary>3f3c6d78206c</Binary>
 *     </ValueAnnotation>
 * Binary contents coded in hexadecimal.
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.1.1
 * XSD Type: TBinaryConstantExpression
 */
class BinaryConstant extends ConstantBase
{
    /**
     * Construct
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value
     *
     * @param string $value
     * @return string
     */
    public function value(string $value = null):string
    {
        if (null !== $value) {
            // stripe any white space
            $value = preg_replace('/\s+/', '', $value);
            if (!ctype_xdigit($value)) {
                throw new InvalidArgumentException(
                    sprintf("values assigned %s to should be hexadecimal string", __CLASS__)
                );
            }
            $this->__value = $value;
        }
        return $this->__value;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Binary';
    }
}
