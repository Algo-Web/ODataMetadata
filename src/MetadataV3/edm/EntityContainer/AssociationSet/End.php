<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer\AssociationSet;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Documentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.20 AssociationSet End
 *
 * The End element defines the two sides of the AssociationSet element. This association is defined between the two
 * EntitySets declared in an EntitySet attribute.
 *
 * The following is an example of the End element.
 *
 * <End Role="Customer" EntitySet="CustomerSet" />
 *
 * The following rules apply to End elements inside an AssociationSet:
 * - End element can have the Role attribute specified. All End elements have the EntitySet attribute specified.
 * - The EntitySet is the Name of an EntitySet defined inside the same EntityContainer.
 * - The Role of the End element MUST map to a Role declared on one of the Ends of the Assocation referenced by the End
 *   element's declaring AssociationSet.
 * - Each End that is declared by an AssociationSet refers to a different Role.
 * - The EntityType for a particular AssociationSetEnd is the same as or derived from the EntityType that is contained
 *   by the related EntitySet. An End element can contain a maximum of one Documentation element.
 * - End can contain any number of AnnotationElement elements.
 * - The child elements of End are to appear in this sequence: Documentation, AnnotationElement.

 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl12.3.1
 */
class End extends EdmBase
{
    use HasDocumentation;
    /**
     * @var string $role An association set end MUST provide a [simpleidentifier][csdl19] value for the edm:Role
     * attribute that is the same as the value of one of the association ends' edm:Role attribute.
     */
    private $role;

    /**
     * @var string $entitySet The edm:End element MUST also provide a [simpleidentifier][csdl19] or
     * [qualifiedidentifier][csdl19] value for the edm:EntitySet attribute. The entity set that is named MUST expose
     * the entity type bound by the corresponding end of the association.
     */
    private $entitySet;

    public function __construct(string $entitySet, string $role = null, Documentation $documentation = null)
    {
        $this
            ->setEntitySet($entitySet)
            ->setRole($role)
            ->setDocumentation($documentation);
    }

    /**
     * Gets as role
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Sets a new role
     *
     * @param string $role
     * @return self
     */
    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Gets as entitySet
     *
     * @return string
     */
    public function getEntitySet(): string
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet
     *
     * @param string $entitySet
     * @return self
     */
    public function setEntitySet(string $entitySet): self
    {
        $this->entitySet = $entitySet;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'End';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Role', $this->getRole()),
            new AttributeContainer('EntitySet', $this->getEntitySet()),
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

