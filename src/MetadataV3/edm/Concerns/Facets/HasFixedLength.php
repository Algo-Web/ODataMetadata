<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * Trait HasFixedLength
 *
 * 5.3.3 The edm:FixedLength Attribute
 *
 * A binary, stream or string edm:Property MAY define a [nonnegativeintegral][csdl19] value
 * for the edm:FixedLength facet attribute. The value of this attribute specifies the size of the array used to
 * store the value of the property on a type instance.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.3.3
 * @mixin EdmBase
 */
trait HasFixedLength
{
    /**
     * @var int $fixedLength
     */
    private $fixedLength = null;


    /**
     * Gets as fixedLength
     *
     * @return int|null
     */
    public function getFixedLength(): ?int
    {
        return $this->fixedLength;
    }

    /**
     * Sets a new fixedLength
     *
     * @param int|null $fixedLength
     * @return self
     */
    public function setFixedLength(?int $fixedLength): self
    {
        $this->fixedLength = $fixedLength;
        return $this;
    }

    public function getAttributesHasFixedLength(): array
    {
        return [new AttributeContainer('FixedLength', $this->getFixedLength(), true)];
    }
}
