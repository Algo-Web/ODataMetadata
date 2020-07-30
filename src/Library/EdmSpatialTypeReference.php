<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IType;

class EdmSpatialTypeReference extends EdmPrimitiveTypeReference implements ISpatialTypeReference
{
    /**
     * @var int
     */
    private $spatialReferenceIdentifier;

    /**
     * Initializes a new instance of the <see cref="EdmSpatialTypeReference"/> class.
     *
     * @param IPrimitiveType $definition                 the type this reference refers to
     * @param bool           $isNullable                 denotes whether the type can be nullable
     * @param int|null       $spatialReferenceIdentifier spatial Reference Identifier for the spatial type being created
     */
    public function __construct(IPrimitiveType $definition, bool $isNullable, ?int $spatialReferenceIdentifier = null)
    {
        parent::__construct($definition, $isNullable);
        if (null === $spatialReferenceIdentifier) {
            switch ($definition->getPrimitiveKind()) {
                case PrimitiveTypeKind::Geography():
                case PrimitiveTypeKind::GeographyPoint():
                case PrimitiveTypeKind::GeographyLineString():
                case PrimitiveTypeKind::GeographyPolygon():
                case PrimitiveTypeKind::GeographyCollection():
                case PrimitiveTypeKind::GeographyMultiPolygon():
                case PrimitiveTypeKind::GeographyMultiLineString():
                case PrimitiveTypeKind::GeographyMultiPoint():
                    $spatialReferenceIdentifier = CsdlConstants::Default_SpatialGeographySrid;
                    break;

                // In the case of a BadSpatialTypeReference, the PrimitiveTypeKind is none, and we will treat that the same as Geometry.
                default:
                    $spatialReferenceIdentifier = CsdlConstants::Default_SpatialGeometrySrid;
                    break;
            }
        }
        $this->spatialReferenceIdentifier = $spatialReferenceIdentifier;
    }

    /**
     * @return bool gets a value indicating whether this type is nullable
     */
    public function getNullable(): bool
    {
        return parent::getNullable();
    }

    /**
     * @return IType|null gets the definition to which this type refers
     */
    public function getDefinition(): ?IType
    {
        return parent::getDefinition();
    }

    /**
     * @return int|null gets the precision of this temporal type
     */
    public function getSpatialReferenceIdentifier(): ?int
    {
        return $this->spatialReferenceIdentifier;
    }
}
