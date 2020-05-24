<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Documentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer\AssociationSet\End;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.19 AssociationSet
 *
 * An AssociationSet contains relationship instances of the specified association. The association specifies the
 * EntityType elements of the two end points, whereas AssociationSet specifies the EntitySet element that corresponds
 * to either these EntityType elements directly or to derived EntityType elements. The association instances that are
 * contained in the AssociationSet relate entity instances that belong to these EntityType elements.
 *
 * The following is an example of the AssociationSet.
 *
 *     <AssociationSet Name="CustomerOrder" Association="Model1.CustomerOrder">
 *         <End Role="Customer" EntitySet="CustomerSet" />
 *         <End Role="Order" EntitySet="OrderSet" />
 *     </AssociationSet>
 *
 * The following rules apply to the AssociationSet element:
 * - AssociationSet MUST have a Name attribute defined that is of type SimpleIdentifier.
 * - AssociationSet MUST have an Association attribute defined. The Association attribute specifies the namespace
 *   qualified name or alias qualified name of the Association for which the AssociationSet is being defined.
 * - The Association of an AssociationSet MUST be in scope of the Schema that declares the EntityContainer in which this
 *   AssociationSet resides.
 * - AssociationSet can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - An AssociationSet element can contain a maximum of one Documentation element.
 * - AssociationSet MUST have exactly two End child elements defined.
 * - AssociationSet can contain any number of AnnotationElement child elements.
 * - Child elements of AssociationSet are to appear in this sequence: Documentation, End, AnnotationElement.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl12.3
 */
class AssociationSet extends EdmBase
{
    use HasDocumentation;
    /**
     * @var string $name An association set MUST provide a [simpleidentifier][csdl19] value for the edm:Name attribute.
     */
    private $name;

    /**
     * @var string $association An association set also has an edm:Association attribute that MUST be provided
     * with a [qualifiedidentifier][csdl19] that resolves to an association in the entity model.
     */
    private $association;


    /**
     * @var End $endOne
     */
    private $endOne = null;
    /**
     * @var End $endTwo
     */
    private $endTwo = null;

    public function __construct(string $name, string $association, End $endOne = null, End $endTwo = null, Documentation $documentation = null)
    {
        $this
            ->setName($name)
            ->setAssociation($association)
            ->setEndOne($endOne)
            ->setEndTwo($endTwo)
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
     * Gets as association
     *
     * @return string
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Sets a new association
     *
     * @param string $association
     * @return self
     */
    public function setAssociation($association)
    {
        $this->association = $association;
        return $this;
    }

    /**
     * Gets the first end
     *
     * @return End|null
     */
    public function getEndOne()
    {
        return $this->endOne;
    }

    /**
     * Sets a first end
     *
     * @param End|null $end
     * @return self
     */
    public function setEndOne(?End $end):self
    {
        $this->endOne = $end;
        return $this;
    }

    /**
     * Gets the second end
     *
     * @return End|null
     */
    public function getEndTwo()
    {
        return $this->endTwo;
    }

    /**
     * Sets the second end
     *
     * @param End|null $end
     * @return self
     */
    public function setEndTwo(?End $end):self
    {
        $this->endTwo = $end;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'AssociationSet';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Name', $this->getName()),
            new AttributeContainer('Association', $this->getAssociation()),
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [
            $this->getDocumentation(),
            $this->getEndOne()
            , $this->getEndTwo(),
        ];
    }
}
