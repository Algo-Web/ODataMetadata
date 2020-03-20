<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\Multiplicity;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.9 Association End.
 *
 * For a given Association, the End element defines one side of the relationship. End defines what type is participating in the relationship, multiplicity or the cardinality, and if there are any operation associations, like cascade delete.
 *
 * The following is an example of an End element.
 *
 *    <End Type="Model1.Customer" Role="Customer" Multiplicity="1" />
 *
 * The following rules apply to the Association End element:
 * - End MUST define the EntityType for this end of the relationship.
 * - EntityType is either a namespace qualified name or an alias qualified name of an EntityType that is in scope.
 * - End MUST specify the Multiplicity of this end.
 * - End can specify the Role name.
 * - End can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute attributes
 *   cannot collide.
 * - End can contain a maximum of one Documentation element.
 * - At most, one OnDelete operation can be defined on a given End.
 * - End can contain any number of AnnotationElement elements.
 * - Child elements of End are to appear in this sequence: Documentation, OnDelete, AnnotationElement.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl10.2
 * XSD Type: TAssociationEnd
 */
class AssociationEnd extends EdmBase
{
    /*
     * End can contain a maximum of one Documentation element.


     */
    use HasDocumentation;
    /**
     * @var string $type 10.2.1 The edm:Type Attribute
     *             Each end of the association MUST specify the entity type attached to that end. The value of the edm:Type
     *             attribute must be a [singleentitytypereference][csdl19]. The value of the type attribute MUST resolve to an
     *             entity type in the entity model.
     */
    private $type;

    /**
     * @var string $role 10.2.2 The edm:Role Attribute
     *             The edm:Role attribute allows the association end to be bound to a navigation property. The association end MAY
     *             assign a [simpleidentifier][csdl19] value to the edm:Role attribute.
     */
    private $role = null;

    /**
     * @var Multiplicity $multiplicity 10.2.3 The edm:Multiplicity Attribute
     *                   The edm:Multiplicity attribute defines the cardinality of the association end. The value of the attribute MUST
     *                   be one of the following:
     *                   - 0..1  zero or one
     *                   - 1  exactly one
     *                   - *  zero or more
     */
    private $multiplicity;

    /**
     * @var OnDelete $onDelete 10.3 The edm:OnDelete Element
     *               The edm:OnDelete element prescribes the action that should be taken when the entity on the opposing end of the
     *               association is deleted.
     *
     * If present, the edm:OnDelete element MUST define a value for the edm:Action attribute. The value assigned to the
     * action attribute MUST be Cascade or None.
     */
    private $onDelete = null;

    public function __construct(string $type, Multiplicity $multiplicity, string $role = null, OnDelete $onDelete = null)
    {
        $this
            ->setType($type)
            ->setMultiplicity($multiplicity)
            ->setRole($role)
            ->setOnDelete($onDelete);
    }

    /**
     * Gets as type.
     *
     * @return string
     */
    public function getType():string
    {
        return $this->type;
    }

    /**
     * Sets a new type.
     *
     * @param  string $type
     * @return self
     */
    public function setType(string $type):self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets as role.
     *
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * Sets a new role.
     *
     * @param  string|null $role
     * @return self
     */
    public function setRole(?string $role): self
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Gets as multiplicity.
     *
     * @return Multiplicity
     */
    public function getMultiplicity(): Multiplicity
    {
        return $this->multiplicity;
    }

    /**
     * Sets a new multiplicity.
     *
     * @param  Multiplicity $multiplicity
     * @return self
     */
    public function setMultiplicity(Multiplicity $multiplicity): self
    {
        $this->multiplicity = $multiplicity;
        return $this;
    }

    /**
     * Gets as onDelete.
     *
     * @return OnDelete
     */
    public function getOnDelete(): OnDelete
    {
        return $this->onDelete;
    }

    /**
     * Sets a new onDelete.
     *
     * @param  OnDelete $onDelete
     * @return self
     */
    public function setOnDelete(OnDelete $onDelete): self
    {
        $this->onDelete = $onDelete;
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
            new AttributeContainer('Type', $this->getType()),
            new AttributeContainer('Role', $this->getRole(), true),
            new AttributeContainer('Multiplicity', $this->getMultiplicity()),

        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [
            $this->getDocumentation(),
            $this->getOnDelete()
        ];
    }
}
