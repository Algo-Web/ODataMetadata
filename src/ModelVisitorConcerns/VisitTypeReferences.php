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
                $this->processCollectionTypeReference($reference->asCollection());
                break;
            case TypeKind::Complex():
                $this->processComplexTypeReference($reference->asComplex());
                break;
            case TypeKind::Entity():
                $this->processEntityTypeReference($reference->asEntity());
                break;
            case TypeKind::EntityReference():
                $this->processEntityReferenceTypeReference($reference->asEntityReference());
                break;
            case TypeKind::Enum():
                $this->processEnumTypeReference($reference->asEnum());
                break;
            case TypeKind::Primitive():
                $this->visitPrimitiveTypeReference($reference->asPrimitive());
                break;
            case TypeKind::Row():
                $this->processRowTypeReference($reference->asRow());
                break;
            case TypeKind::None():
                $this->processTypeReference($reference);
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
                $this->processBinaryTypeReference($reference->asBinary());
                break;
            case PrimitiveTypeKind::Decimal():
                $this->processDecimalTypeReference($reference->asDecimal());
                break;
            case PrimitiveTypeKind::String():
                $this->processStringTypeReference($reference->asString());
                break;
            case PrimitiveTypeKind::DateTime():
            case PrimitiveTypeKind::DateTimeOffset():
            case PrimitiveTypeKind::Time():
                $this->processTemporalTypeReference($reference->asTemporal());
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
                $this->processSpatialTypeReference($reference->asSpatial());
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
