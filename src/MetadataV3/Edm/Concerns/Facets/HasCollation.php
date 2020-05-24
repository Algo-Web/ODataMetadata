<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Facets;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\MetadataV3\EDMSimpleType;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * Trait HasCollation
 *
 * 5.3.7 The edm:Collation Attribute
 *
 * A string property MAY define a value for the edm:Collation attribute. The value of this attribute specifies a
 * collation sequence that can be used for comparison and ordering operations.
 * The value of the collation attribute MUST be one of the following:
 * Binary, Boolean, Byte, DateTime, DateTimeOffset, Time, Decimal, Double, Single, Guid, Int16, Int32, Int64, String,
 * SByte
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.3.7
 * @mixin EdmBase
 */
trait HasCollation
{
    /**
     * @var EDMSimpleType $collation
     */
    private $collation = null;
    /**
     * Gets as collation
     *
     * @return EDMSimpleType|null
     */
    public function getCollation(): ?EDMSimpleType
    {
        return $this->collation;
    }

    /**
     * Sets a new collation
     *
     * @param EDMSimpleType|null $collation
     * @return self
     */
    public function setCollation(?EDMSimpleType $collation):self
    {
        $this->collation = $collation;
        return $this;
    }

    public function getAttributesHasCollection(): array
    {
        return [new AttributeContainer('Collection', $this->getCollation(), true)];
    }
}
