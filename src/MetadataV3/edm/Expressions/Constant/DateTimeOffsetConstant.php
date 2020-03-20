<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Constant;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DateTime;

/**
 * Class representing TDateTimeOffsetConstantExpressionType.
 *
 * 16.1.4 The Edm:DateTimeOffset Constant Expression
 *
 * The Edm:DateTimeOffset constant expression evaluates to a primitive date/time value with a UTC offset. An
 * Edm:DateTimeOffset expression MUST be assigned a value of the type [xs:datetime][csdl19].
 *
 * An Edm:DateTimeOffset expression may be written with either element notation or attribute notation,
 * as shown in the following examples:
 *
 *     <ValueAnnotation Term="org.example.display.LastUpdated" DateTimeOffset="2000-01-01T16:00:00.000Z-09:00" />
 *
 *     <ValueAnnotation Term="org.example.display.LastUpdated">
 *         <DateTime>2000-01-01T16:00:00.000Z-09:00</DateTime>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.1.
 * XSD Type: TDateTimeOffsetConstantExpression
 */
class DateTimeOffsetConstant extends ConstantBase
{
    /**
     * Construct.
     *
     * @param DateTime $value
     */
    public function __construct(DateTime $value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value.
     *
     * @param  DateTime $value
     * @return DateTime
     */
    public function value(DateTime $value = null): DateTime
    {
        if (null !== $value) {
            $this->__value = $value;
        }
        return $this->__value;
    }

    /**
     * Gets a string value.
     *
     * @return string
     */
    public function __toString()
    {
        // xsd:dateTime is the same as RFCRFC3339
        return $this->__value->format(DateTime::RFC3339);
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'DateTimeOffset';
    }
}
