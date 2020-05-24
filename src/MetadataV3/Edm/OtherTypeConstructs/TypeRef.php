<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasFacets;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Documentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use AlgoWeb\ODataMetadata\Writer\IAttribute;

/**
 * 2.1.26 TypeRef
 *
 * The TypeRef element is used to reference an existing named type.
 *
 * The following is an example of a TypeRef element with the Name attribute specified.
 *
 *     <TypeRef Type="Model.Person" />
 *
 * The following is an example of a TypeRef with facets specified.
 *
 *     <TypeRef Type="Edm.String" Nullable="true" MaxLength="50"/>
 *
 * The following rules apply to the TypeRef element:
 * - TypeRef MUST have a Type attribute defined. The Type attribute defines the fully qualified name of the referenced
 *   type.
 * - TypeRef is used to reference an existing named type. Named types include:
 * - - EntityType
 * - - ComplexType
 * - - Primitive type
 * - - EnumType
 * - TypeRef can define facets if the type is a scalar type. The Default facet cannot be applied to a TypeRef.
 * - TypeRef can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - TypeRef elements can contain at most one Documentation element.
 * - TypeRef elements can contain any number of AnnotationElement elements.
 * - AnnotationElement is last in the sequence of child elements of TypeRef.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl9.2
 * XSD Type: TTypeRef
 */
class TypeRef extends EdmBase implements IStructuralTypes, IAttribute
{
    use HasDocumentation, HasFacets;
    /**
     * @var INominalType $type
     */
    private $type;

    public function __construct(INominalType $type, Documentation $documentation = null)
    {
        $this
            ->setType($type)
            ->setDocumentation($documentation);
    }

    /**
     * Gets as type
     *
     * @return INominalType
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets a new type
     *
     * @param INominalType $type
     * @return self
     */
    public function setType(INominalType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'TypeRef';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        $baseAttribute = [
            new AttributeContainer('Type', $this->getType()->getName())
        ];
        return $this->getType() instanceof IScalarType ?
            array_merge($this->getAttributesHasFacets(), $baseAttribute) :
            $baseAttribute;
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getDocumentation()];
    }

    public function getAttributeValue(): ?string
    {
        return $this->getType()->getName();
    }

    public function getAttributeNullCheck(): bool
    {
        return true;
    }

    public function getAttributeForVersion(): OdataVersions
    {
        return OdataVersions::ONE();
    }

    public function getAttributeProhibitedVersion(): array
    {
        return [];
    }

    public function getAttributePrefix(): ?string
    {
        return null;
    }

    public function getAttributeName(): string
    {
        return 'Type';
    }

    public function isAttribute(): bool
    {
        return false; //TODO: basically we check to see if Type is the only thing set, if so yes we are an attribute;
    }
}
