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
    public static function ToTraceString(?IEdmElement $element): string
    {
        switch (true) {
            case $element instanceof ISchemaElement:
                assert($element instanceof ISchemaElement);
                return $element->FullName();
            case $element instanceof ITypeReference:
                assert($element instanceof ITypeReference);
                $s = '[';
                $s .= self::ToTraceString($element->getDefinition());
                $s = self::AppendKeyValue($s, EdmConstants::FacetName_Nullable, $element->getNullable() ? 'TRUE' : 'FALSE');
                if ($element->isPrimitive()) {
                    $s = self::AppendFacets($s, $element->AsPrimitive());
                }
                $s .= ']';
                return $s;
            case $element instanceof IProperty:
                assert($element instanceof IProperty);
                $type = $element->getType();
                return $element->getName() ?? '' . ':' . ($type !== null ? self::ToTraceString($type) :'');
            case $element instanceof IEntityReferenceType:
                assert($element instanceof IEntityReferenceType);
                return TypeKind::EntityReference()->getKey() . '(' . ($element->getEntityType() !== null ? self::ToTraceString($element->getEntityType()) : '') . ')';
            case $element instanceof ICollectionType:
                assert($element instanceof ICollectionType);
                return TypeKind::Collection()->getKey() . '(' . ($element->getElementType() != null ? self::ToTraceString($element->getElementType()) : '') . ')';
            case $element instanceof IRowType:
                assert($element instanceof IRowType);
                $s = TypeKind::Row()->getKey();
                $s .= '(';
                foreach ($element->Properties() as $prop) {
                    if (null === $prop) {
                        continue;
                    }
                    $s .= self::ToTraceString($prop);
                    $s .= ', ';
                }
                $s = substr($s, 0, -2);
                $s .= ')';
                return $s;
            default:
                return EdmConstants::Value_UnknownType;
        }
    }

    private static function AppendFacets(string $s, IPrimitiveTypeReference $type): string
    {
        switch ($type->PrimitiveKind()) {
            case PrimitiveTypeKind::Binary():
                $s = self::AppendBinaryFacets($s, $type->AsBinary());
                break;
            case PrimitiveTypeKind::Decimal():
                $s = self::AppendDecimalFacets($s, $type->AsDecimal());
                break;
            case PrimitiveTypeKind::String():
                $s = self::AppendStringFacets($s, $type->AsString());
                break;
            case PrimitiveTypeKind::Time():
            case PrimitiveTypeKind::DateTime():
            case PrimitiveTypeKind::DateTimeOffset():
                $s = self::AppendTemporalFacets($s, $type->AsTemporal());
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
                $s = self::AppendSpatialFacets($s, $type->AsSpatial());
                break;
        }
        return $s;
    }


    private static function AppendBinaryFacets(string $sb, IBinaryTypeReference $type): string
    {
        self::AppendKeyValue($sb, EdmConstants::FacetName_FixedLength, $type->isFixedLength() ? 'TRUE' : 'FALSE');
        if ($type->isUnBounded() || null !== $type->getMaxLength()) {
            $sb = self::AppendKeyValue($sb, EdmConstants::FacetName_MaxLength, ($type->isUnBounded()) ? EdmConstants::Value_Max : strval($type->getMaxLength()));
        }
        return $sb;
    }

    private static function AppendStringFacets(string $sb, IStringTypeReference $type): string
    {
        if (true === $type->isFixedLength()) {
            $sb = self::AppendKeyValue($sb, EdmConstants::FacetName_FixedLength, $type->isFixedLength() ? 'TRUE' : 'FALSE');
        }

        if (true === $type->isUnbounded() || null !== $type->getMaxLength()) {
            $sb = self::AppendKeyValue($sb, EdmConstants::FacetName_MaxLength, $type->isUnbounded() ? EdmConstants::Value_Max : $type->getMaxLength());
        }

        if (true === $type->isUnicode()) {
            $sb = self::AppendKeyValue($sb, EdmConstants::FacetName_Unicode, $type->isUnicode() ? 'TRUE' : 'FALSE');
        }

        if (null !== $type->getCollation()) {
            $sb = self::AppendKeyValue($sb, EdmConstants::FacetName_Collation, $type->getCollation());
        }
        return $sb;
    }

    private static function AppendTemporalFacets(string $sb, ITemporalTypeReference $type): string
    {
        if (null !== $type->getPrecision()) {
            $sb = self::AppendKeyValue($sb, EdmConstants::FacetName_Precision, $type->getPrecision());
        }
        return $sb;
    }

    private static function AppendDecimalFacets(string $sb, IDecimalTypeReference $type): string
    {
        if (null !== $type->getPrecision()) {
            $sb = self::AppendKeyValue($sb, EdmConstants::FacetName_Precision, $type->getPrecision());
        }

        if (null !== $type->getScale()) {
            $sb = self::AppendKeyValue($sb, EdmConstants::FacetName_Scale, $type->getScale());
        }
        return $sb;
    }

    private static function AppendSpatialFacets(string $sb, ISpatialTypeReference $type): string
    {
        $sb = self::AppendKeyValue(
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
    private static function AppendKeyValue(string $s, string $key, $value)
    {
        $s .= ' ';
        $s .= $key;
        $s .= '=';
        $s .= $value;
        return $s;
    }
}
