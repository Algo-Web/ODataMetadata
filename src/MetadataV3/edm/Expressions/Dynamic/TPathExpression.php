<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

/**
 * Class representing TPropertyReferenceExpressionType.
 *
 *16.2.13 The Edm:Path Expression
 *
 * The Edm:Path expression enables a value to be obtained by traversing an object graph. The Edm:Path expression must
 * be assigned a value of the type [pathstring][csdl19].
 *
 * The value assigned to the path expression MUST be composed of zero or more segments joined together by forward
 * slashes. Each segment MUST represent a type cast, a property or a navigation property.
 *
 * If the path segment represents a type cast, the segment MUST be of the type [qualifiedidentifier][csdl19]. If the
 * path segment represents a property or a navigation property, the segment MUST be of the type
 * [simpleidentifier][csdl19] and MUST resolve to a property or a navigation property of the same name.
 *
 * If a path segment traverses a navigation property that has a cardinality of many, the path MUST NOT have any
 * subsequent segments.
 *
 * If the Edm:Path expression is an empty string or an empty element, the path MUST refer to the containing object.
 *
 * The Edm:Path expression may be written with either element notation or attribute notation, as shown in the following
 * examples:
 *
 *     <ValueAnnotation Term="org.example.display.DisplayName" Path="FirstName" />
 *
 *     <ValueAnnotation Term="org.example.display.DisplayName">
 *         <Path>FirstName</Path>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.13
 * @see https://docs.microsoft.com/en-us/openspecs/windows_protocols/mc-csdl/3f24f40e-f24d-4c7b-8407-b75a90566806
 * XSD Type: TPathExpression
 */
class TPathExpression extends DynamicBase
{
    /**
     * @var string $__value
     */
    protected $__value = null;

    /**
     * Gets a string value.
     *
     * @return string
     */
    public function __toString(): string
    {
        return strval($this->__value);
    }

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
}
