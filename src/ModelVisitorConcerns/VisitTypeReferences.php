<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IComplexTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IRowTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Trait VisitTypeReferences.
 * @package AlgoWeb\ODataMetadata\ModelVisitorConcerns
 * @mixin EdmModelVisitor
 */
trait VisitTypeReferences
{
    public function visitTypeReference(ITypeReference $reference): void
    {
        switch ($reference->getDefinition()->getTypeKind()) {
            case TypeKind::Collection():
                $this->processCollectionTypeReference($reference->AsCollection());
                break;
            case TypeKind::Complex():
                $this->ProcessComplexTypeReference($reference->AsComplex());
                break;
            case TypeKind::Entity():
                $this->ProcessEntityTypeReference($reference->AsEntity());
                break;
            case TypeKind::EntityReference():
                $this->ProcessEntityReferenceTypeReference($reference->AsEntityReference());
                break;
            case TypeKind::Enum():
                $this->ProcessEnumTypeReference($reference->AsEnum());
                break;
            case TypeKind::Primitive():
                $this->VisitPrimitiveTypeReference($reference->AsPrimitive());
                break;
            case TypeKind::Row():
                $this->ProcessRowTypeReference($reference->AsRow());
                break;
            case TypeKind::None():
                $this->ProcessTypeReference($reference);
                break;
            default:
                throw new InvalidOperationException(StringConst::UnknownEnumVal_TypeKind($reference->getDefinition()->getTypeKind()->getKey()));
        }
    }

    abstract public function processCollectionTypeReference(ICollectionTypeReference $reference): void;
    abstract public function ProcessComplexTypeReference(IComplexTypeReference $reference): void;
    abstract public function ProcessEntityTypeReference(IEntityTypeReference $reference): void;
    abstract public function ProcessEntityReferenceTypeReference(IEntityReferenceTypeReference $reference): void;
    abstract public function ProcessEnumTypeReference(IEnumTypeReference $reference): void;
    abstract public function ProcessRowTypeReference(IRowTypeReference $reference): void;
    abstract public function ProcessTypeReference(ITypeReference $reference): void;

    public function visitPrimitiveTypeReference(IPrimitiveTypeReference $reference): void
    {
        switch ($reference->PrimitiveKind()) {
            case PrimitiveTypeKind::Binary():
                $this->processBinaryTypeReference($reference->AsBinary());
                break;
            case PrimitiveTypeKind::Decimal():
                $this->processDecimalTypeReference($reference->AsDecimal());
                break;
            case PrimitiveTypeKind::String():
                $this->processStringTypeReference($reference->AsString());
                break;
            case PrimitiveTypeKind::DateTime():
            case PrimitiveTypeKind::DateTimeOffset():
            case PrimitiveTypeKind::Time():
                $this->processTemporalTypeReference($reference->AsTemporal());
                break;
            case PrimitiveTypeKind::Geography():
            case PrimitiveTypeKind::GeographyPoint():
            case PrimitiveTypeKind::GeographyLineString():
            case PrimitiveTypeKind::GeographyPolygon():
            case PrimitiveTypeKind::GeographyCollection():
            case PrimitiveTypeKind::GeographyMultiPolygon():
            case PrimitiveTypeKind::GeographyMultiLineString():
            case PrimitiveTypeKind::GeographyMultiPoint():
            case PrimitiveTypeKind::Geometry():
            case PrimitiveTypeKind::GeometryPoint():
            case PrimitiveTypeKind::GeometryLineString():
            case PrimitiveTypeKind::GeometryPolygon():
            case PrimitiveTypeKind::GeometryCollection():
            case PrimitiveTypeKind::GeometryMultiPolygon():
            case PrimitiveTypeKind::GeometryMultiLineString():
            case PrimitiveTypeKind::GeometryMultiPoint():
                $this->processSpatialTypeReference($reference->AsSpatial());
                break;
            case PrimitiveTypeKind::Boolean():
            case PrimitiveTypeKind::Byte():
            case PrimitiveTypeKind::Double():
            case PrimitiveTypeKind::Guid():
            case PrimitiveTypeKind::Int16():
            case PrimitiveTypeKind::Int32():
            case PrimitiveTypeKind::Int64():
            case PrimitiveTypeKind::SByte():
            case PrimitiveTypeKind::Single():
            case PrimitiveTypeKind::Stream():
            case PrimitiveTypeKind::None():
                $this->processPrimitiveTypeReference($reference);
                break;
            default:
                throw new InvalidOperationException(StringConst::UnknownEnumVal_PrimitiveKind($reference->PrimitiveKind()->getKey()));
        }
    }

    abstract public function processBinaryTypeReference(IBinaryTypeReference $AsBinary): void;
    abstract public function processDecimalTypeReference(IDecimalTypeReference $AsDecimal): void;
    abstract public function processPrimitiveTypeReference(IPrimitiveTypeReference $reference): void;
    abstract public function processSpatialTypeReference(ISpatialTypeReference $AsSpatial): void;
    abstract public function processTemporalTypeReference(ITemporalTypeReference $AsTemporal): void;
    abstract public function processStringTypeReference(IStringTypeReference $AsString): void;
}
