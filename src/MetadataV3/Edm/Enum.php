<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\INominalType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\IScalarType;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.37 EnumType
 *
 * An EnumType element is used in CSDL 3.0 to declare an enumeration type. Enumeration types are scalar types.
 *
 * An enumeration type has a Name attribute, an optional UnderlyingType attribute, an optional IsFlags attribute, and
 * a payload that consists of zero or more declared Member elements.
 *
 * The following is an example of the EnumType element.
 *
 *     <EnumType Name="ContentType" UnderlyingType="Edm.Int32" IsFlags="true">
 *         <Member Name="Liquid" Value="1"/>
 *         <Member Name="Perishable" Value="2"/>
 *         <Member Name="Edible" Value="4"/>
 *     </EnumType>
 *
 * Enumeration types are equal-comparable, order-comparable, and can participate in entity Key elements—that is, they
 * can be the Key or can be a part of the Key. An enumeration can be categorized as an EDM type.
 *
 * The following rules apply to the EnumType element:
 * - EnumType elements MUST specify a Name attribute that is of type SimpleIdentifier.
 * - EnumType is a schema level named element and has a unique name.
 * - EnumType elements can specify an UnderlyingType attribute which is an integral EDMSimpleType, such as:
 *   SByte, Int16, Int32, Int64, or Byte. Edm.Int32 is assumed if it is not specified in the declaration.
 * - EnumType elements can specify an IsFlags Boolean attribute, which are assumed to be false if it is not specified
 *   in the declaration. If the enumeration type can be treated as a bit field, IsFlags is set to "true".
 * - EnumType elements can contain a list of zero or more Member child elements that are referred to as declared
 *   enumeration members.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl8.1
 * XSD Type: TEnumType
 */
class Enum extends EdmBase implements INominalType, IScalarType
{
    use HasDocumentation;

    /**
     * @var string $name EnumType elements MUST specify a Name attribute that is of type SimpleIdentifier.
     * EnumType is a schema level named element and has a unique name.
     */
    private $name;

    /**
     * @var bool $isFlags 8.1.2 The edm:IsFlags Attribute
     * An enumeration type MAY specify a [boolean][csdl19] value for the edm:IsFlags attribute. A value of true
     * indicates that the enumeration type allows multiple members to be selected simultaneously.
     * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl8.1.2
     */
    private $isFlags = false;

    /**
     * @var string $underlyingType 8.1.1 The edm:UnderlyingType Attribute
     * An enumeration type has an underlying type which specifies the allowable values for member mapping.
     *
     * The enumeration type MUST assign an value to the edm:UnderlyingType attribute. If the underlying type is not
     * specified, a 32-bit integer MUST be used as the underlying type.
     * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl8.1.1
     */
    private $underlyingType = null;


    /**
     * @var EnumMember[] $member The enumeration type element contains zero or more child edm:Member elements
     * enumerating the members of the enum.
     */
    private $member = [];

    public function __construct(string $name, $isFlags = false, string $underlyingType = null, array $member = [])
    {
        $this
            ->setName($name)
            ->setIsFlags($isFlags)
            ->setUnderlyingType($underlyingType)
            ->setMember($member);
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
    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as isFlags
     *
     * @return bool
     */
    public function getIsFlags(): bool
    {
        return $this->isFlags;
    }

    /**
     * Sets a new isFlags
     *
     * @param bool $isFlags
     * @return self
     */
    public function setIsFlags(bool $isFlags):self
    {
        $this->isFlags = $isFlags;
        return $this;
    }

    /**
     * Gets as underlyingType
     *
     * @return string|null
     */
    public function getUnderlyingType(): ?string
    {
        return $this->underlyingType;
    }

    /**
     * Sets a new underlyingType
     *
     * @param string|null $underlyingType
     * @return self
     */
    public function setUnderlyingType(?string $underlyingType): self
    {
        $this->underlyingType = $underlyingType;
        return $this;
    }

    /**
     * Adds as member
     *
     * @param EnumMember $member
     * @return self
     */
    public function addToMember(EnumMember $member): self
    {
        $this->member[$member->getName()] = $member;
        return $this;
    }

    /**
     * isset member
     *
     * @param string $index
     * @return bool
     */
    public function issetMember(string $index): bool
    {
        return isset($this->member[$index]);
    }

    /**
     * unset member
     *
     * @param string $index
     * @return void
     */
    public function unsetMember($index): void
    {
        unset($this->member[$index]);
    }

    /**
     * Gets as member
     *
     * @return EnumMember[]
     */
    public function getMember(): array
    {
        return $this->member;
    }

    /**
     * Sets a new member
     *
     * @param EnumMember[] $member
     * @return self
     */
    public function setMember(array $member): self
    {
        $this->member = $this->elementToNamedArray($member);
        return $this;
    }


    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'EnumType';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Name', $this->getName()),
            new AttributeContainer('UnderlyingType', $this->getUnderlyingType(), true),
            new AttributeContainer('IsFlags', $this->getIsFlags(), true),
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return $this->getMember();
    }

    public function isAttribute(): bool
    {
        return false;
    }
}
