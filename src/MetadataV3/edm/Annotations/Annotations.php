<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Annotations;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasAnnotations;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.35 Annotations
 *
 * The Annotations element is used to group one or more TypeAnnotation or ValueAnnotation elements that target the same model element.
 *
 * The following is an example of the Annotations element.
 *
 *     <Annotations Target="Model" Qualifier="Slate">
 *          <ValueAnnotation Term="Title" String="ShortTitle" />
 *     </Annotations>
 *
 * The following rules apply to the Annotations element:
 * - The Annotations element MUST have a Target attribute defined. The Target attribute names the element to which the contained TypeAnnotation and ValueAnnotation elements apply. Target has to be a namespace qualified name, alias qualified name, or FunctionImport Name.
 * - The Target attribute MUST target one of the following:
 * - - ComplexType
 * - - EntitySet
 * - - EntityType
 * - - EnumType
 * - - Function
 * - - FunctionImport
 * - - NavigationProperty
 * - - Parameter
 * - - Property
 * - - ValueTerm
 * - - Entity Data Model (EDM) primitive type
 * - Annotations can appear only in Schema level.
 * - Annotations can have a Qualifier attribute that is of type SimpleIdentifier.
 * - Annotations MUST contain one or more TypeAnnotation or ValueAnnotation elements.
 *
 * Annotations can appear only in Schema level.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl15.1
 * @link https://docs.microsoft.com/en-us/openspecs/windows_protocols/mc-csdl/9fb2fa3c-5aac-4430-87c6-6786314b1588
 * XSD Type: TAnnotations
 */
class Annotations extends EdmBase
{
    use HasAnnotations;
    /**
     * @var string $target The Annotations element MUST have a Target attribute defined. The Target attribute names the
     * element to which the contained TypeAnnotation and ValueAnnotation elements apply. Target has to be a namespace
     * qualified name, alias qualified name, or FunctionImport Name.
     *
     * The Target attribute MUST target one of the following:
     * ComplexType
     * EntitySet
     * EntityType
     * EnumType
     * Function
     * FunctionImport
     * NavigationProperty
     * Parameter
     * Property
     * ValueTerm
     * Entity Data Model (EDM) primitive type
     */
    private $target;

    /**
     * @var string $qualifier Annotations can have a Qualifier attribute that is of type SimpleIdentifier.
     */
    private $qualifier = null;


    /**
     * Gets as target
     *
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * Sets a new target
     *
     * @param string $target
     * @return self
     */
    public function setTarget(string $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Gets as qualifier
     *
     * @return string|null
     */
    public function getQualifier(): ?string
    {
        return $this->qualifier;
    }

    /**
     * Sets a new qualifier
     *
     * @param string|null $qualifier
     * @return self
     */
    public function setQualifier(?string $qualifier): self
    {
        $this->qualifier = $qualifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Annotations';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer("Target", $this->getTarget()),
            new AttributeContainer("Qualifier", $this->getQualifier(), true)
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return array_merge($this->getValueAnnotation(), $this->getTypeAnnotation());
    }
}

