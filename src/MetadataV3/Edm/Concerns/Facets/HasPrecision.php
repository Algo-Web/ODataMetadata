<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Facets;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * Trait HasPrecision
 *
 * 5.3.4 The edm:Precision Attribute
 *
 * A temporal or decimal edm:Property MAY define a [nonnegativeintegral][csdl19] value for the
 * edm:Precision attribute.
 *
 * For a decimal property the value of this attribute specifies the maximum number of digits allowed in the
 * property's value. For a temporal property the value of this attribute specifies the number of decimal places
 * allowed in the seconds portion of the property's value.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.3.4
 * @mixin EdmBase
 */
trait HasPrecision
{
    /**
     * @var int $precision
     */
    private $precision = null;
    /**
     * Gets as precision
     *
     * @return int|null
     */
    public function getPrecision(): ?int
    {
        return $this->precision;
    }

    /**
     * Sets a new precision
     *
     * @param int|null $precision
     * @return self
     */
    public function setPrecision(?int $precision): self
    {
        $this->precision = $precision;
        return $this;
    }

    public function getAttributesHasPrecision(): array
    {
        return [new AttributeContainer('Precision', $this->getPrecision(), true)];
    }
}
