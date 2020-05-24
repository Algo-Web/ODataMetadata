<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.38 EnumType Member
 *
 * A Member element is used inside an EnumType element to declare a member of an enumeration type.
 *
 * For example, the following enumeration type has three discrete members:
 *
 *      <EnumType Name=" ShippingMethod">
 *         <Member Name="FirstClass" />
 *         <Member Name="TwoDay" />
 *         <Member Name="Overnight" />
 *     </EnumType>
 *
 * The following rules apply to declared enumeration type members:
 * - Member elements MUST specify a Name attribute that is unique within the EnumType declaration.
 * - Member elements can specify the Value attribute that is a valid Edm.Long.
 * - The order of the Member elements has meaning and MUST be preserved.
 * - If the value of the Member element is not specified, the value is zero for the first member and one more than
 *   the value of the previous member for subsequent members.

Multiple members with different Name attributes can have the same Value attributes. When mapping from a value of the underlying type to a Member of an EnumType, the first matching Member is used.
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl8.2.1
 * * XSD Type: TEnumTypeMember
 */
class EnumMember extends EdmBase
{
    use HasDocumentation;
    /**
     * @var string $name 8.2.1 The edm:Name Attribute
     * Each enumeration member MUST provide a [simpleidentifier][csdl19] value for the edm:Name attribute. The
     * enumeration type MUST NOT declare two members with the same name.
     * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl8.2.1
     */
    private $name = null;

    /**
     * @var int|null $value 8.2.2 The edm:Value Attribute
     *
     * The value of an enum member allows entity instances to be sorted by a property that has an enum member for
     * its value. If the value is not explicitly set, the value MUST be assigned to 0 for the first member or one
     * plus the previous member value for any subsequent members.
     *
     * The value MUST be a valid value for the edm:UnderlyingType of the enumeration type.
     *
     * In the example that follows, FirstClass MUST be assigned a value of 0, TwoDay a value of 4, and Overnight a
     * value of 5.
     *
     *     <EnumType Name="ShippingMethod">
     *         <Member Name="FirstClass" />
     *         <Member Name="TwoDay" Value="4" />
     *         <Member Name="Overnight" />
     *     </EnumType>
     *
     * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl8.2.2
     */
    private $value = null;

    public function __construct(string $name, string $value = null, Documentation $documentation = null)
    {
        $this
            ->setName($name)
            ->setValue($value)
            ->setDocumentation($documentation);
    }

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as value
     *
     * @return int|null
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * Sets a new value
     *
     * @param int|null $value
     * @return self
     */
    public function setValue(?int $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Member';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Name', $this->getName()),
            new AttributeContainer('Value' , $this->getValue(), true)
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getDocumentation()];
    }
}

