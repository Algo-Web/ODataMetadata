<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

abstract class ToTraceString
{
    /**
     * Returns the text representation of the current object.
     *
     * @param  IEdmElement|null $element reference to the calling object
     * @return string           the text representation of the current object
     */
    public static function toTraceString(?IEdmElement $element): string
    {
        switch (true) {
            case $element instanceof ISchemaElement:
                assert($element instanceof ISchemaElement);
                return $element->fullName();
            case $element instanceof ITypeReference:
                assert($element instanceof ITypeReference);
                $s = '[';
                $s .= self::toTraceString($element->getDefinition());
                $s = self::appendKeyValue(
                    $s,
                    EdmConstants::FacetName_Nullable,
                    $element->getNullable() ? 'TRUE' : 'FALSE'
                );
                if ($element->isPrimitive()) {
                    $s = self::appendFacets($s, $element->asPrimitive());
                }
                $s .= ']';
                return $s;
            case $element instanceof IProperty:
                assert($element instanceof IProperty);
                $type = $element->getType();
                return $element->getName() ?? '' . ':' . ($type !== null ? self::toTraceString($type) :'');
            case $element instanceof IEntityReferenceType:
                assert($element instanceof IEntityReferenceType);
                return strval(TypeKind::EntityReference()->getKey()) . '(' . (null !== $element->getEntityType() ?
                        self::toTraceString($element->getEntityType()) : '') . ')';
            case $element instanceof ICollectionType:
                assert($element instanceof ICollectionType);
                return strval(TypeKind::Collection()->getKey()) . '(' . (null !== $element->getElementType() ?
                        self::toTraceString($element->getElementType()) : '') . ')';
            case $element instanceof IRowType:
                assert($element instanceof IRowType);
                $s = TypeKind::Row()->getKey();
                $s .= '(';
                foreach ($element->properties() as $prop) {
                    if (null === $prop) {
                        continue;
                    }
                    $s .= self::toTraceString($prop);
                    $s .= ', ';
                }
                $s = substr($s, 0, -2);
                $s .= ')';
                return $s;
            default:
                return EdmConstants::Value_UnknownType;
        }
    }

    private static function appendFacets(string $s, IPrimitiveTypeReference $type): string
    {
        switch ($type->primitiveKind()) {
            case PrimitiveTypeKind::Binary():
                $s = self::appendBinaryFacets($s, $type->asBinary());
                break;
            case PrimitiveTypeKind::Decimal():
                $s = self::appendDecimalFacets($s, $type->asDecimal());
                break;
            case PrimitiveTypeKind::String():
                $s = self::appendStringFacets($s, $type->asString());
                break;
            case PrimitiveTypeKind::Time():
            case PrimitiveTypeKind::DateTime():
            case PrimitiveTypeKind::DateTimeOffset():
                $s = self::appendTemporalFacets($s, $type->asTemporal());
                break;
            case PrimitiveTypeKind::Geography():
            case PrimitiveTypeKind::GeographyPoint():
            case PrimitiveTypeKind::GeographyLineString():
            case PrimitiveTypeKind::GeographyPolygon():
            case PrimitiveTypeKind::GeographyCollection():
            case PrimitiveTypeKind::GeographyMultiPoint():
            case PrimitiveTypeKind::GeographyMultiLineString():
            case PrimitiveTypeKind::GeographyMultiPolygon():
            case PrimitiveTypeKind::Geometry():
            case PrimitiveTypeKind::GeometryPoint():
            case PrimitiveTypeKind::GeometryLineString():
            case PrimitiveTypeKind::GeometryPolygon():
            case PrimitiveTypeKind::GeometryCollection():
            case PrimitiveTypeKind::GeometryMultiPolygon():
            case PrimitiveTypeKind::GeometryMultiLineString():
            case PrimitiveTypeKind::GeometryMultiPoint():
                $s = self::appendSpatialFacets($s, $type->asSpatial());
                break;
        }
        return $s;
    }


    private static function appendBinaryFacets(string $sb, IBinaryTypeReference $type): string
    {
        self::appendKeyValue($sb, EdmConstants::FacetName_FixedLength, $type->isFixedLength() ? 'TRUE' : 'FALSE');
        if ($type->isUnBounded() || null !== $type->getMaxLength()) {
            $sb = self::appendKeyValue(
                $sb,
                EdmConstants::FacetName_MaxLength,
                ($type->isUnBounded()) ? EdmConstants::Value_Max : strval($type->getMaxLength())
            );
        }
        return $sb;
    }

    private static function appendStringFacets(string $sb, IStringTypeReference $type): string
    {
        if (true === $type->isFixedLength()) {
            $sb = self::appendKeyValue(
                $sb,
                EdmConstants::FacetName_FixedLength,
                'TRUE'
            );
        }

        if (true === $type->isUnbounded() || null !== $type->getMaxLength()) {
            $sb = self::appendKeyValue(
                $sb,
                EdmConstants::FacetName_MaxLength,
                $type->isUnbounded() ? EdmConstants::Value_Max : $type->getMaxLength()
            );
        }

        if (true === $type->isUnicode()) {
            $sb = self::appendKeyValue($sb, EdmConstants::FacetName_Unicode, 'TRUE');
        }

        if (null !== $type->getCollation()) {
            $sb = self::appendKeyValue($sb, EdmConstants::FacetName_Collation, $type->getCollation());
        }
        return $sb;
    }

    private static function appendTemporalFacets(string $sb, ITemporalTypeReference $type): string
    {
        if (null !== $type->getPrecision()) {
            $sb = self::appendKeyValue($sb, EdmConstants::FacetName_Precision, $type->getPrecision());
        }
        return $sb;
    }

    private static function appendDecimalFacets(string $sb, IDecimalTypeReference $type): string
    {
        if (null !== $type->getPrecision()) {
            $sb = self::appendKeyValue($sb, EdmConstants::FacetName_Precision, $type->getPrecision());
        }

        if (null !== $type->getScale()) {
            $sb = self::appendKeyValue($sb, EdmConstants::FacetName_Scale, $type->getScale());
        }
        return $sb;
    }

    private static function appendSpatialFacets(string $sb, ISpatialTypeReference $type): string
    {
        $sb = self::appendKeyValue(
            $sb,
            EdmConstants::FacetName_Srid,
            null !== $type->getSpatialReferenceIdentifier()
                ? $type->getSpatialReferenceIdentifier(): EdmConstants::Value_SridVariable
        );
        return $sb;
    }

    /**
     * @param  string          $s
     * @param  string          $key
     * @param  string|int|null $value
     * @return string
     */
    private static function appendKeyValue(string $s, string $key, $value)
    {
        $s .= ' ';
        $s .= $key;
        $s .= '=';
        $s .= $value;
        return $s;
    }
}
