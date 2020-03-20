<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets;

use AlgoWeb\ODataMetadata\MetadataV3\ConcurrencyMode;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * Trait HasConcurrencyMode.
 *
 * 5.3.10 The edm:ConcurrencyMode Attribute
 *
 *  An edm:Property MAY define a value for the edm:ConcurrencyMode attribute.
 * The value of this attribute indicates how concurrency should be handled for the property.
 *
 * The value of the concurrency mode attribute MUST be None or Fixed. If no value is specified, the value defaults
 * to None.
 *
 * When used on a property of an entity type, the concurrency mode attribute specifies that the value of that
 * property SHOULD be used for optimistic concurrency checks.
 *
 * The concurrency mode attribute MUST NOT be applied to any properties of a complex type.
 *
 * The concurrency mode attribute MUST NOT be applied to properties whose type is a complex type
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.3.10
 * @mixin EdmBase
 */
trait HasConcurrencyMode
{
    /**
     * @var ConcurrencyMode $concurrencyMode
     */
    private $concurrencyMode = null;
    /**
     * Gets as concurrencyMode.
     *
     * @return ConcurrencyMode|null
     */
    public function getConcurrencyMode(): ?ConcurrencyMode
    {
        return $this->concurrencyMode;
    }

    /**
     * Sets a new concurrencyMode.
     *
     * @param  ConcurrencyMode|null $concurrencyMode
     * @return self
     */
    public function setConcurrencyMode(?ConcurrencyMode $concurrencyMode): self
    {
        $this->concurrencyMode = $concurrencyMode;
        return $this;
    }

    public function getAttributesHasConcurrencyMode(): array
    {
        return [new AttributeContainer('ConcurrencyMode', $this->getConcurrencyMode(), true)];
    }
}
