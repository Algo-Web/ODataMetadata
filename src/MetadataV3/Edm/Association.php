<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.8 Association.
 *
 * An Association element defines a peer-to-peer relationship between participating EntityType elements and can support
 * different multiplicities at the two ends. OnDelete operational behavior can be specified at any end of the
 * relationship. An association type can be categorized as an EDM type.
 *
 * An example of an association is the relationship between the Customer and Order entities. Typically, this
 * relationship has the following characteristics:
 *
 * Multiplicity: Each Order is associated with exactly one Customer. Every Customer has zero or more Orders.
 *
 * Operational behavior: OnDelete Cascade; when an Order with one or more OrderLines is deleted, the corresponding
 * OrderLines also get deleted.
 *
 * The following is an example of an Association element.
 *
 * <Association Name="CustomerOrder">
 * <End Type="Model1.Customer" Role="Customer" Multiplicity="1" />
 * <End Type="Model1.Order" Role="Order" Multiplicity="*" />
 * </Association>
 *
 * The following rules apply to the Association element:
 * - Association MUST have a Name attribute defined. The Name attribute is of type SimpleIdentifier.
 * - An Association is a schema level named element and has a unique name.
 * - Association can contain any number of AnnotationAttribute attributes. The full names of AnnotationAttribute
 *   cannot collide.
 * - An Association element can contain a maximum of one Documentation element.
 * - Association MUST have exactly two End elements defined.
 * - Association can have one ReferentialConstraint element defined.
 * - Association can contain any number of AnnotationElement elements.
 * - Child elements of Association are to appear in this sequence: Documentation, End, ReferentialConstraint,
 *   AnnotationElement.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl10
 * XSD Type: TAssociation
 */
class Association
{
    /*
     * An Association element can contain a maximum of one Documentation element.
     */
    use HasDocumentation;
    /**
     * @var string $name Association MUST have a Name attribute defined. The Name attribute is of type SimpleIdentifier.
     *             An Association is a schema level named element and has a unique name.
     */
    private $name;

    /**
     * Association MUST have exactly two End elements defined.
     * @var AssociationEnd $endOne
     */
    private $endOne = null;
    /**
     * Association MUST have exactly two End elements defined.
     * @var AssociationEnd $endTwo
     */
    private $endTwo = null;

    /**
     * @var ReferentialConstraint $referentialConstraint association can have one ReferentialConstraint element defined
     */
    private $referentialConstraint = null;

    public function __construct(string $name, AssociationEnd $endOne = null, AssociationEnd $endTwo = null, ReferentialConstraint $referentialConstraint = null, Documentation $documentation = null)
    {
        $this
            ->setName($name)
            ->setReferentialConstraint($referentialConstraint)
            ->setEndOne($endOne)
            ->setEndTwo($endTwo)
            ->setDocumentation($documentation);
    }
    /**
     * Gets as name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets a new name.
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets the first end.
     *
     * @return AssociationEnd|null
     */
    public function getEndOne(): ?AssociationEnd
    {
        return $this->endOne;
    }

    /**
     * Sets a first end.
     *
     * @param  AssociationEnd|null $end
     * @return self
     */
    public function setEndOne(?AssociationEnd $end): self
    {
        $this->endOne = $end;
        return $this;
    }

    /**
     * Gets the second end.
     *
     * @return AssociationEnd|null
     */
    public function getEndTwo(): ?AssociationEnd
    {
        return $this->endTwo;
    }

    /**
     * Sets the second end.
     *
     * @param  AssociationEnd|null $end
     * @return self
     */
    public function setEndTwo(?AssociationEnd $end)
    {
        $this->endTwo = $end;
        return $this;
    }
    /**
     * Gets as referentialConstraint.
     *
     * @return ReferentialConstraint|null
     */
    public function getReferentialConstraint(): ?ReferentialConstraint
    {
        return $this->referentialConstraint;
    }

    /**
     * Sets a new referentialConstraint.
     *
     * @param  ReferentialConstraint|null $referentialConstraint
     * @return self
     */
    public function setReferentialConstraint(?ReferentialConstraint $referentialConstraint): self
    {
        $this->referentialConstraint = $referentialConstraint;
        return $this;
    }


    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Association';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Name', $this->getName())
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [
            $this->getDocumentation(),
            $this->getEndOne(),
            $this->getEndTwo(),
            $this->getReferentialConstraint()
        ];
    }
}
