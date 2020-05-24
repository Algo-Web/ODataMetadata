<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns;

use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasCollation;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasDefaultValue;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasFixedLength;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasMaxLength;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasNullable;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasPrecision;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasScale;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasSRID;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasUnicode;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * Trait HasFacets
 *
 * 5.3 Property Facets
 * Property facets allow a model to provide additional constraints or data about the value of structural properties.
 * Facets are expressed as attributes on the property element.
 *
 * Facets apply to the type referenced in the element where the facet is declared. If the type is a collection type
 * declared with attribute notation, the facets apply to the types in the collection. In the following example,
 * the Nullable facet applies to the DateTime type.
 *
 *     <Property Name="SuggestedTimes" Type="Collection(Edm.DateTime)" Nullable="true" />
 *
 * In the following example the Nullable attribute MUST be placed on the child element that references the DateTime
 * type. Facet attributes MUST NOT be applied to Collection type references.
 *
 *     <ReturnType>
 *         <Collection>
 *             <TypeRef Type="Edm.DateTime" Nullable="true" />
 *         </Collection>
 *     </ReturnType>
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.3
 * XSD Type: TFacetAttributes
 */
trait HasFacets
{
    use HasCollation,
        HasDefaultValue,
        HasFixedLength,
        HasMaxLength,
        HasNullable,
        HasPrecision,
        HasScale,
        HasSRID,
        HasUnicode;

    public function getAttributesHasFacets(): array{
        return array_merge(
            $this->getAttributesHasCollection(),
            $this->getAttributesHasDefaultValue(),
            $this->getAttributesHasFixedLength(),
            $this->getAttributesHasMaxLength(),
            $this->getAttributesHasNullable(),
            $this->getAttributesHasPrecision(),
            $this->getAttributesHasScale(),
            $this->getAttributesHasSRID(),
            $this->getAttributesHasUnicode()
        );
    }
}