<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets;


use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * Class HasSRID
 *
 * 5.3.8 The edm:SRID Attribute
 *
 *  A spatial property MAY define a value for the edm:SRID attribute.
 * The value of this attribute identifies which spatial reference system is applied to values of the property on
 * type instances.
 *
 * The value of the SRID attribute MUST be a [nonnegativeint32][csdl19] or the special value variable.
 * If no value is specified, the attribute defaults to 0 for Geometry types or 4326 for Geography types.
 * The valid values of the SRID attribute and their meanings are as defined by the
 * [European Petroleum Survey Group (EPSG)][http://www.epsg.org/Geodetic.html].
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.3.8
 * @mixin EdmBase
 */
trait HasSRID
{
    /**
     * @var string $sRID
     */
    private $sRID = null;

    /**
     * Gets as sRID
     *
     * @return string|null
     */
    public function getSRID(): ?string
    {
        return $this->sRID;
    }
    /**
     * Sets a new sRID
     *
     * @param string|null $sRID
     * @return self
     */
    public function setSRID(?string $sRID)
    {
        $this->sRID = $sRID;
        return $this;
    }

    public function getAttributesHasSRID(): array{
        return [new AttributeContainer('SRID', $this->getSRID(), true, OdataVersions::THREE())];
    }
}