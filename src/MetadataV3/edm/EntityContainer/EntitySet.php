<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasAnnotations;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\HasValueAnnotation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Documentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.18 EntitySet
 *
 * An EntitySet element is a named set that can contain instances of a specified EntityType element and any of the
 * specified EntityType subtypes. More than one EntitySet for a particular EntityType can be defined.
 *
 * The following is an example of the EntitySet element.
 *
 *     <EntitySet Name="CustomerSet" EntityType="Model1.Customer" />
 *
 * The following rules apply to the EntitySet element:
 * - EntitySet MUST have a Name attribute defined that is of type SimpleIdentifier.
 * - EntitySet MUST have an EntityType defined.
 * - The EntityType of an EntitySet MUST be in scope of the Schema that declares the EntityContainer in which this
 *   EntitySet resides.
 * - EntitySet can have an abstract EntityType. An EntitySet for a given EntityType can contain instances of that
 *   EntityType and any of its subtypes.
 * - Multiple EntitySet elements can be defined for a given EntityType.
 * - EntitySet can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - EntitySet elements can contain a maximum of one Documentation element.
 * - EntitySet can contain any number of AnnotationElement elements.
 * - In CSDL 3.0, EntitySet can contain any number of ValueAnnotation elements.
 * - Child elements of EntitySet are to appear in this sequence:  Documentation, AnnotationElement.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl12.2
 */
class EntitySet extends EdmBase
{
    use HasDocumentation, HasAnnotations, HasValueAnnotation;
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $entityType
     */
    private $entityType;

    public function __construct(string $name, string $entityType, Documentation $documentation = null)
    {
        $this->setName($name)
            ->setEntityType($entityType)
            ->setDocumentation($documentation);
    }

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName():string
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
     * Gets as entityType
     *
     * @return string
     */
    public function getEntityType(): string
    {
        return $this->entityType;
    }

    /**
     * Sets a new entityType
     *
     * @param string $entityType
     * @return self
     */
    public function setEntityType(string $entityType): self
    {
        $this->entityType = $entityType;
        return $this;
    }
    /*
         * @return string
         */
    public function getDomName(): string
    {
        return 'EntitySet';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Name', $this->getName()),
            new AttributeContainer('EntityType', $this->getEntityType())
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getDocumentation(), $this->getValueAnnotation()];
    }
}

