<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Constant;

use DateTime;

/**
 * Class representing TDateTimeConstantExpressionType.
 *
 * 16.1.3 The Edm:DateTime Constant Expression
 *
 * The Edm:DateTime constant expression evaluates to a primitive date/time value. A date/time expression MUST be
 * assigned a value of the type [xs:datetime][csdl19]. The UTC offset portion of this value MUST be discarded.
 *
 * A date/time expression may be written with either element notation or attribute notation, as shown in the following
 * examples:
 *
 *     <ValueAnnotation Term="org.example.display.LastUpdated" DateTime="2000-01-01T16:00:00.000" />
 *
 *     <ValueAnnotation Term="org.example.display.LastUpdated">
 *         <DateTime>2000-01-01T16:00:00.000</DateTime>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.1.3
 * XSD Type: TDateTimeConstantExpression
 */
class DateTimeConstant extends ConstantBase
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
        return 'DateTime';
    }
}
