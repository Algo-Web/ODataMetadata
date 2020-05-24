<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\HasFacets;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.25 CollectionType
 *
 * If the type of the FunctionParameter or ReturnType is a collection, the type can be expressed as an attribute or
 * by using child element syntax.
 *
 * The following is an example of the type expressed as an attribute.
 *
 *     <Parameter Name="Owners" Type="Collection(Model.Person)" />
 *
 * The following is an example of the type expressed by using child element syntax.
 *
 *     <Parameter Name="Owners">
 *         <CollectionType>
 *             <TypeRef Name="Model.Person" />
 *         </CollectionType>
 *     </Parameter>
 *
 * The following rules apply to the CollectionType element:
 * - CollectionType MUST define the type either as an attribute or as a child element.
 * - Attribute syntax can be used only if the collection is a nominal type.
 * - CollectionType can define facets if the type is a scalar type. The Default facet cannot be applied to a CollectionType.
 * - CollectionType can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute attributes cannot collide.
 * - CollectionType can define one of the following as a child element:
 * - CollectionType
 * - ReferenceType
 * - RowType
 * - TypeRef
 * - CollectionType elements can contain any number of AnnotationElement elements.
 * - AnnotationElement is last in the sequence of child elements of CollectionType.
 *
 * XSD Type: TCollectionType
 */
class CollectionType extends EdmBase implements IStructuralTypes
{
    use HasFacets;
    /**
     * @var IType $containerFor
     */
    private $containerFor = null;

    /**
     * Gets the containerFor
     *
     * @return IType
     */
    public function getContainerFor(): IType
    {
        return $this->containerFor;
    }

    /**
     * Sets a new containerFor
     *
     * @param IType $containerFor
     * @return self
     */
    public function setContainerFor(IType $containerFor): self
    {
        $this->containerFor = $containerFor;
        return $this;
    }


    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'CollectionType';
    }

    /**
     * @return array|AttributeContainer[]
     */

    public function getAttributes(): array
    {
        $containerFor = $this->getContainerFor();
        if ($containerFor instanceof IStructuralTypes
        ) {
            return [];
        }

        $baseAttribute = [
            new AttributeContainer('Type', strval($containerFor))
        ];
        return $containerFor instanceof IScalarType ?
            array_merge($this->getAttributesHasFacets(), $baseAttribute) :
            $baseAttribute;
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        $containerFor = $this->getContainerFor();
        if ($containerFor instanceof CollectionType ||
            $containerFor instanceof ReferenceType ||
            $containerFor instanceof RowType ||
            $containerFor instanceof TypeRef
        ) {
            return [$this->containerFor];
        }
        return [];
    }
}
