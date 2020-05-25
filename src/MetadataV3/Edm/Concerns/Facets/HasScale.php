<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Facets;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * Trait HasScale.
 *
 * 5.3.5 The edm:Scale Attribute
 *
 *  A decimal edm:Property MAY define a [nonnegativeintegral][csdl19] value for the edm:Scale
 * attribute. The value of this attribute specifies the maximum number of digits allowed to the right of the
 * decimal point.
 *
 * The value of the edm:Scale attribute MUST be less than or equal to the value of the edm:Precision attribute.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.3.5
 * @mixin EdmBase
 */
trait HasScale
{
    /**
     * @var int|null $scale
     */
    private $scale = null;

    /**
     * Gets as scale.
     *
     * @return int|null
     */
    public function getScale(): ?int
    {
        return $this->scale;
    }

    /**
     * Sets a new scale.
     *
     * @param  int|null $scale
     * @return self
     */
    public function setScale(?int $scale): self
    {
        $this->scale = $scale;
        return $this;
    }

    public function getAttributesHasScale(): array
    {
        return [new AttributeContainer('Scale', $this->getScale(), true)];
    }
}
