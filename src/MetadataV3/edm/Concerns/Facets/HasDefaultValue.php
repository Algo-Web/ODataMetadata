<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * Trait HasDefaultValue.
 *
 * 5.3.9 The edm:DefaultValue Attribute
 *
 * A string property MAY define a value for the edm:DefaultValue attribute. The value
 * of this attribute determines the value of the property on new type instances.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.3.9
 * @mixin EdmBase
 */
trait HasDefaultValue
{
    /**
     * @var string $defaultValue
     */
    private $defaultValue = null;

    /**
     * Gets as defaultValue.
     *
     * @return string|null
     */
    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    /**
     * Sets a new defaultValue.
     *
     * @param  string|null $defaultValue
     * @return self
     */
    public function setDefaultValue(?string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    public function getAttributesHasDefaultValue(): array
    {
        return [new AttributeContainer('DefaultValue', $this->getDefaultValue(), true)];
    }
}
