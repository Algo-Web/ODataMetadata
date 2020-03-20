<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\AccessorType;
use AlgoWeb\ODataMetadata\MetadataV3\ConcurrencyMode;
use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasAccessors;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasCommonPropertyAttributes;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\HasValueAnnotation;
use AlgoWeb\ODataMetadata\MetadataV3\EDMSimpleType;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.3 Property
 * The declared properties of an EntityType element or ComplexType element are defined by using the Property element.
 * EntityType and ComplexType can have Property elements. Property can be a scalar type or ComplexType. A declared
 * property description consists of the declared property's name, type, and a set of facets, such as Nullable or
 * Default. Facets describe further behavior of a given type; they are optional to define.
 *
 * The following is an example of a Property element.
 *
 * <Property Name="ProductName" Type="String" Nullable="false" MaxLength="40">
 *
 * The following rules apply to the Property element:
 * - The Property MUST define the Name attribute.
 * - The Property MUST have the Type defined.
 * - The Property type is either a scalar type or a ComplexType that is in scope and that has a namespace qualified
 * name or alias qualified name.
 * - In CSDL 3.0, a Type attribute in the Property element can have the value "Collection". "Collection" represents a
 *   set of non-nullable scalar type instances or ComplexType instances. It can be expressed as an attribute (example 1)
 *   or by using child element syntax, see TypeRef (section 2.1.26) (example 2). TypeRef is only allowed if the Type
 *   attribute value is equal to "Collection".
 * - - In example 1, Property uses a Type attribute.
 * - -     <Property Name="AlternateAddresses" Type="Collection(Model.Address)" />
 * - - In example 2, Property uses child element syntax.
 * - -     <Property Name="AlternateAddresses" Type="Collection">
 * - -         <TypeRef Type="Model.Address" />
 * - -     </Property>
 * - Property can define a Nullable facet. The default value is Nullable=true. In CSDL 1.0, CSDL 1.1, and CSDL 2.0, any
 *   Property that has a type of ComplexType also defines a Nullable attribute that is set to "false".
 * - The following facets are optional to define on Property:
 * - - DefaultValue
 * - - MaxLength
 * - - FixedLength
 * - - Precision
 * - - Scale
 * - - Unicode
 * - - Collation
 * - - SRID
 * - In CSDL 1.1, CSDL 1.2, CSDL 2.0, and CSDL 3.0, a Property element can define a CollectionKind attribute. The
 *   possible values are "None", "List", and "Bag".
 * - Property can define ConcurrencyMode. The possible values are "None" and "Fixed". However, for an EntityType that
 *   has a corresponding EntitySet defined, any EntityType elements that are derived from the EntitySet MUST NOT define
 *   any new Property with ConcurrencyMode set to a value other than "None".
 * - Property can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - A Property element can contain a maximum of one Documentation element.
 * - Property can contain any number of AnnotationElement elements.
 * - In CSDL 3.0, Property can contain any number of ValueAnnotation elements.
 * - Child elements of Property are to appear in this sequence: Documentation, AnnotationElement.
 *
 *
 * A dynamic property follows these rules:
 * - If an instance of an OpenEntityType does not include a value for a dynamic property named N, the instance is
 *   treated as if it includes N with a value of "null".
 * - A dynamic property of an OpenEntityType cannot have the same name as a declared property on the same
 *   OpenEntityType.
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.1
 * XSD Type: TEntityProperty
 */
class Property extends EdmBase
{
    use HasValueAnnotation,
        HasCommonPropertyAttributes,
        HasDocumentation,
        HasAccessors;
    public function __construct(string $name,
                                string $type,
                                bool $nullable = null,
                                string $defaultValue = null,
                                int $maxLength = null,
                                int $fixedLength = null, int
                                $precision = null,
                                int $scale = null,
                                bool $unicode = true,
                                EDMSimpleType $collection = null,
                                ConcurrencyMode $concurrencyMode = null,
                                Documentation $documentation = null,
                                AccessorType $setterAccess = null,
                                AccessorType $getterAccess = null)
    {
        $this->setName($name)
            ->setType($type)
            ->setNullable($nullable)
            ->setDefaultValue($defaultValue)
            ->setMaxLength($maxLength)
            ->setFixedLength($fixedLength)
            ->setPrecision($precision)
            ->setScale($scale)
            ->setUnicode($unicode)
            ->setCollation($collection)
            ->setConcurrencyMode($concurrencyMode)
            ->setDocumentation($documentation)
            ->setGetterAccess($getterAccess)
            ->setSetterAccess($setterAccess);
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Property';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return $this->getAttributesHasCommonPropertyAttributes();
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [
            $this->getDocumentation(),
            $this->getValueAnnotation()
        ];
    }
}
