<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasType;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.31 ValueTerm
 *
 * A ValueTerm element is used to define a value term in Entity Data Model (EDM).
 * The following is an example of a ValueTerm element.
 *
 * <ValueTerm Name="Title" Type="Edm.String">
 *
 * The following rules apply to the ValueTerm element:
 * - The ValueTerm element appears under the Schema element.
 * - The ValueTerm element has a Name attribute that is of type SimpleIdentifier. The Name of a ValueTerm has to be
 *   unique across all named elements that are defined in the same namespace.
 * - The ValueTerm element MUST have a Type attribute. Type is of the type ComplexType, primitive type, or EnumType, or
 *   a collection of ComplexType or primitive types.
 * - The ValueTerm element can have a DefaultValue attribute to provide a value for the ValueTerm if the term is applied
 *   but has no value specified.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl14.2
 * XSD Type: TValueTerm
 */
class ValueTerm extends EdmBase
{
    use HasType, HasDocumentation;
    /**
     * @var string $name
     */
    private $name;

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'ValueTerm';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Name', $this->getName()),
            $this->getAttributesHasType()
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getChildElementsHasType()];
    }
}
