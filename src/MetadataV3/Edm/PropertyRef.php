<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * 2.1.6 PropertyRef.
 *
 * PropertyRef element refers to a declared property of an EntityType.
 *
 * The following is an example of PropertyRef.
 *
 *     <PropertyRef Name="CustomerId" />
 *
 * The following rules apply to the PropertyRef element:
 * - PropertyRef can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes MUST NOT collide.
 * - PropertyRef MUST define the Name attribute. The Name attribute refers to the name of a Property defined in the
 *   declaring EntityType.
 * - In CSDL 2.0 and CSDL 3.0, PropertyRef can contain any number of AnnotationElement elements.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl6.3
 * XSD Type: TPropertyRef
 */
class PropertyRef extends EdmBase
{

    /**
     * @var string $name PropertyRef MUST define the Name attribute. The Name attribute refers to the name of a
     *             Property defined in the declaring EntityType.
     */
    private $name;

    public function __construct(string $name)
    {
        $this
            ->setName($name);
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


    public function XmlSerialize(DOMElement $parent)
    {
        $propRef = self::getSerilizationContext()->createEdmElement('PropertyRef');
        $propRef->setAttribute('Name', $this->getName());
        $parent->appendChild($propRef);
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'PropertyRef';
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
        return [];
    }
}
