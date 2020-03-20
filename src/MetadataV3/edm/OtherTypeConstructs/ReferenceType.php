<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Documentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Entity;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use AlgoWeb\ODataMetadata\Writer\IAttribute;

/**
 * 2.1.27 ReferenceType.
 *
 * ReferenceType is used to specify the reference to an actual entity either in the return type or in a parameter definition. The reference type can be specified as an attribute or by using child element syntax.
 *
 * The following is an example of the ReferenceType in a return type.
 *
 *     <ReferenceType Type="Model.Person" />
 *
 * The following is an example of the ReferenceType in a parameter definition.
 *
 *     <ReturnType>
 *         <CollectionType>
 *             <ReferenceType Type="Model.Person" />
 *         </CollectionType>
 *     </ReturnType>
 *
 * The following is an example of the ReferenceType as an attribute.
 *
 *     <ReturnType Type="Ref(Model.Person)" />
 *
 * The following rules apply to the ReferenceType element:
 * - The Type attribute on a ReferenceType element MUST always be defined.
 * - The Type of the reference MUST always be of EntityType.
 * - ReferenceType can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - ReferenceType elements can contain at most one Documentation element.
 * - ReferenceType elements can contain any number of AnnotationElement elements.
 * - AnnotationElement is last in the sequence of child elements of ReferenceType.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl9.3
 *
 * XSD Type: TReferenceType
 */
class ReferenceType extends EdmBase implements IStructuralTypes, IAttribute
{
    use HasDocumentation;
    /**
     * @var Entity $type The edm:ReferenceType element represents a reference type in an entity model.
     *
     * A reference type MUST specify a [singleentitytypereference][csdl19] value for the edm:Type attribute.
     * The value of this attribute names the type for which the reference type contains key information.
     */
    private $type;

    public function __construct(Entity $type, Documentation $documentation = null)
    {
        $this
            ->setType($type)
            ->setDocumentation($documentation);
    }

    /**
     * Gets as type.
     *
     * @return Entity
     */
    public function getType(): Entity
    {
        return $this->type;
    }

    /**
     * Sets a new type.
     *
     * @param  Entity $type
     * @return self
     */
    public function setType(Entity $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'ReferenceType';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('type', $this->getType()->getName())
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getDocumentation()];
    }

    public function isAttribute(): bool
    {
        return $this->getDocumentation() === null;
    }

    public function __toString()
    {
        return sprintf('Ref(%s)', $this->getType()->getName());
    }

    public function getAttributeValue(): ?string
    {
        return strval($this);
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
}
