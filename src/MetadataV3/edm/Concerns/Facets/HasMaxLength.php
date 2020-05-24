<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * Trait HasMaxLength
 *
 * 5.3.2 The edm:MaxLength Attribute
 *
 * A binary, stream or string edm:Property MAY define a [nonnegativeintegral][csdl19] value
 * for the edm:MaxLength facet attribute. The value of this attribute specifies the maximum length of the value of
 * the property on a type instance.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.3.2
 * @mixin EdmBase
 */
trait HasMaxLength
{
    /**
     * @var int $maxLength
     */
    private $maxLength = null;

    /**
     * Gets as maxLength
     *
     * @return int|null
     */
    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }

    /**
     * Sets a new maxLength
     *
     * @param int|null $maxLength
     * @return self
     */
    public function setMaxLength(?int $maxLength): self
    {
        $this->maxLength = $maxLength;
        return $this;
    }

    public function getAttributesHasMaxLength(): array
    {
        return [new AttributeContainer('MaxLength', $this->getMaxLength(), true)];
    }
}
