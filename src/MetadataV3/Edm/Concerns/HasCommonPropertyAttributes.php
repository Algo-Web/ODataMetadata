<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Facets\HasConcurrencyMode;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * Trait HasCommonPropertyAttributes
 *
 * 5.1 The edm:Property Element
 *
 * An edm:Property element allows the construction of structural types from a scalar value or a collection of scalar
 * values.
 *
 * For instance, the following property could be used to hold zero or more strings representing the names of
 * measurement units:
 *
 *     <Property Name="Units" Type="Collection(Edm.String)" Nullable="false"/>
 *
 * A property MUST specify a unique name as well as a type and zero or more facets. Facets are attributes that modify
 * or constrain the acceptable values for a property value.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5
 * @link https://docs.microsoft.com/en-us/openspecs/windows_protocols/mc-csdl/50129087-bb7f-475e-a14d-7a8a4bdef966
 * @mixin EdmBase
 * XSD Type: TCommonPropertyAttributes
 */
trait HasCommonPropertyAttributes
{
    use HasFacets,
        HasConcurrencyMode,
        HasAccessors;
    /**
     * @var string $name 5.1.1 The edm:Name Attribute
     *
     * A property MUST specify a [simpleidentifier][csdl19] value for the edm:Name attribute. The name attribute
     * allows a name to be assigned to the property. This name is used when serializing or deserializing OData payloads
     * and can be used for other purposes, such as code generation.
     *
     * The value of the name attribute MUST be unique within the set of properties and navigation properties for the
     * type and any of its base types.
     * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.1.1
     */
    private $name;

    /**
     * @var string $type 5.2 The edm:Type Attribute
     *
     * A property MUST specify a value for the edm:Type attribute. The value of this attribute determines the type for
     * the value of the property on instances of the containing type.
     *
     * The value of the type attribute MUST be of the form [anykeylesstypereference][csdl19]. The value of the type
     * attribute MUST resolve to a complex type, enumeration type or primitive type, or a collection of complex,
     * enumeration or primitive types.
     *
     * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.2
     *
     */
    private $type;

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
     * Gets as type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets a new type
     *
     * @param string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }


    public function getAttributesHasCommonPropertyAttributes(): array
    {
        return array_merge(
            [
                new AttributeContainer('Name', $this->getName(), true),
                new AttributeContainer('Type', $this->getType(), true),
            ],
            $this->getAttributesHasFacets(),
            $this->getAttributesHasConcurrencyMode(),
            $this->getAttributesHasAccessors()
        );
    }
}
