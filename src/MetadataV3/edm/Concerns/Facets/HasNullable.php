<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * Trait HasNullable.
 *
 * 5.3.1 The edm:Nullable Attribute
 *
 * Any edm:Property MAY define a [boolean][csdl19] value for the edm:Nullable facet
 * attribute. The value of this attribute determines whether a value is required for the property on instances of
 * the containing type.
 *
 * If no value is specified, the nullable facet defaults to true.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.3.1
 * @mixin EdmBase
 */
trait HasNullable
{

    /**
     * @var bool $nullable
     */
    private $nullable = true;

    /**
     * Gets as nullable.
     *
     * @return bool
     */
    public function getNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * Sets a new nullable.
     *
     * @param  bool $nullable
     * @return self
     */
    public function setNullable(bool $nullable): self
    {
        $this->nullable = $nullable;
        return $this;
    }

    public function getAttributesHasNullable(): array
    {
        return [new AttributeContainer('Nullable', $this->getNullable(), true)];
    }
}
