<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Constant;

use DateTime;

/**
 * Class representing TTimeConstantExpressionType.
 *
 * 16.1.10 The Edm:Time Constant Expression
 *
 * The Edm:Time constant expression evaluates to a primitive time value. On platforms that do not support a primitive
 * time value, the Time constant expression evaluates to a primitive date/time value. A time expression MUST be
 * assigned a value of the type [xs:time][csdl19].
 *
 * A time expression may be written with either element notation or attribute notation, as shown in the following
 * examples:
 *
 *     <ValueAnnotation Term="org.example.display.EndTime" Time="21:00:00-08:00" />
 *
 *     <ValueAnnotation Term="org.example.display.EndTime">
 *         <Time>21:00:00-08:00</Time>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.1
 * XSD Type: TTimeConstantExpression
 */
class TimeConstant extends ConstantBase
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
        return 'Time';
    }
}
