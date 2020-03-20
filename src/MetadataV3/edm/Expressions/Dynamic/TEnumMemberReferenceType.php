<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

/**
 * Class representing TEnumConstantExpressionType
 *
 * 16.2.5 The Edm:EnumMemberReference Expression
 *
 * The value of an Edm:EnumMemberReference is a reference to a member of an enumeration type.
 *
 * The Edm:EnumMemberReference expression MUST contain a value of the type [qualifiedidentifier][csdl19]. The value of
 * the enum member reference expression MUST resolve to a member of an enumeration type.
 *
 * The Edm:EnumMemberReference expression MUST be written with element notation, as shown in the following example:
 *
 *     <ValueAnnotation Term="org.example.address.Type">
 *         <EnumMemberReference>org.example.address.Type.Mailing</EnumMemberReference>
 *     </ValueAnnotation>
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.2.5
 * XSD Type: TEnumConstantExpression
 */
class TEnumMemberReferenceType extends DynamicBase
{

    /**
     * @var string $__value
     */
    private $__value = null;

    /**
     * Construct
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value
     *
     * @param string $value
     * @return string
     */
    public function value(string $value = null)
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
    public function __toString()
    {
        return strval($this->__value);
    }


}

