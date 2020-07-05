<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Trait VisitTypeReferences.
 * @package AlgoWeb\ODataMetadata\ModelVisitorConcerns
 */
trait VisitTypeReferences
{
    public function visitTypeReference(ITypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        if (null === $reference->getDefinition()) {
            throw new InvalidOperationException(StringConst::UnknownEnumVal_TypeKind('null'));
        }

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
                throw new InvalidOperationException(
                    StringConst::UnknownEnumVal_TypeKind(
                    $reference->getDefinition()->getTypeKind()->getKey()
                )
                );
        }
    }


    public function visitPrimitiveTypeReference(IPrimitiveTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
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
                throw new InvalidOperationException(
                    StringConst::UnknownEnumVal_PrimitiveKind(
                    $reference->PrimitiveKind()->getKey()
                )
                );
        }
    }
}