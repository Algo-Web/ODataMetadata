<?php


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
     * @param IEdmElement $element Reference to the calling object.
     * @return string The text representation of the current object.
     */
    public static function ToTraceString(IEdmElement $element): string{
        switch(true){
            case $element instanceof ISchemaElement:
                assert($element instanceof ISchemaElement);
                return $element->FullName();
            case $element instanceof ITypeReference:
                assert($element instanceof ITypeReference);
                $s = '[';
                $s .= self::ToTraceString($element->getDefinition());
                $s = self::AppendKeyValue($s, EdmConstants::FacetName_Nullable, $element->getNullable() ? 'TRUE' : 'FALSE');
                if($element->isPrimitive()){
                    self::AppendFacets($s, $element->AsPrimitive());
                }
                $s .= ']';
                return $s;
            case $element instanceof IProperty:
                assert($element instanceof IProperty);
                $type = $element->getType();
                return $element->getName() ?? '' . ':' . ($type !== null ? self::ToTraceString($type) :'');
            case $element instanceof IEntityReferenceType:
                assert($element instanceof IEntityReferenceType);
                return TypeKind::EntityReference()->getKey() . '(' . ($element->getEntityType() !== null ? self::ToTraceString($element->getEntityType()) : "") . ')';
            case $element instanceof ICollectionType:
                assert( $element instanceof ICollectionType);
                return TypeKind::Collection()->getKey() .'(' . ($element->getElementType() != null ? self::ToTraceString($element->getElementType()) : "") . ')';
            case $element instanceof IRowType:
                assert($element instanceof IRowType);
                $s = TypeKind::Row()->getKey();
                $s .= '(';
                foreach($element->Properties() as $prop){
                    if($prop === null){
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
                self::AppendBinaryFacets($s, $type->AsBinary());
                break;
            case PrimitiveTypeKind::Decimal():
                self::AppendDecimalFacets($s, $type->AsDecimal());
                break;
            case PrimitiveTypeKind::String():
                self::AppendStringFacets($s, $type->AsString());
                break;
            case PrimitiveTypeKind::Time():
            case PrimitiveTypeKind::DateTime():
            case PrimitiveTypeKind::DateTimeOffset():
                self::AppendTemporalFacets($s, $type->AsTemporal());
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
                self::AppendSpatialFacets($s, $type->AsSpatial());
                break;
        }
        return $s;
    }


    private static function AppendBinaryFacets(string $sb, IBinaryTypeReference $type): string
    {
        self::AppendKeyValue($sb, EdmConstants::FacetName_FixedLength, $type->isFixedLength() ? 'TRUE' : 'FALSE');
        if ($type->isUnBounded() || $type->getMaxLength() != null) {
            self::AppendKeyValue($sb, EdmConstants::FacetName_MaxLength, ($type->isUnBounded()) ? EdmConstants::Value_Max : strval($type->getMaxLength()));
        }
        return $sb;
    }

    private static function AppendStringFacets(string $sb, IStringTypeReference $type): string
    {
        if ($type->isFixedLength() != null)
        {
            self::AppendKeyValue($sb, EdmConstants::FacetName_FixedLength, $type->isFixedLength() ? 'TRUE' : 'FALSE');
        }

        if ($type->isUnbounded() == true || $type->getMaxLength() != null)
        {
            self::AppendKeyValue($sb, EdmConstants::FacetName_MaxLength, $type->isUnbounded() ? EdmConstants::Value_Max : $type->getMaxLength());
        }

        if ($type->isUnicode() != null)
        {
            self::AppendKeyValue($sb, EdmConstants::FacetName_Unicode, $type->isUnicode() ? 'TRUE' : 'FALSE');
        }

        if ($type->getCollation() != null)
        {
            self::AppendKeyValue($sb,EdmConstants::FacetName_Collation, $type->getCollation());
        }
        return $sb;
    }

    private static function AppendTemporalFacets(string $sb, ITemporalTypeReference $type): string
    {
        if ($type->getPrecision() != null)
        {
            self::AppendKeyValue($sb, EdmConstants::FacetName_Precision, $type->getPrecision());
        }
        return $sb;
    }

    private static function AppendDecimalFacets(string $sb, IDecimalTypeReference $type): string
    {
        if ($type->getPrecision() != null)
        {
            self::AppendKeyValue($sb, EdmConstants::FacetName_Precision, $type->getPrecision());
        }

        if ($type->getScale() != null)
        {
            self::AppendKeyValue($sb, EdmConstants::FacetName_Scale, $type->getScale());
        }
        return $sb;
    }

    private static function AppendSpatialFacets(string $sb, ISpatialTypeReference $type): string
    {
        self::AppendKeyValue($sb, EdmConstants::FacetName_Srid, $type->getSpatialReferenceIdentifier() != null ? $type->getSpatialReferenceIdentifier(): EdmConstants::Value_SridVariable);
        return $sb;

    }
    private static function AppendKeyValue(string $s, string $key, string $value)
    {
        $s .= ' ';
        $s .= $key;
        $s .= '=';
        $s .= $value;
        return $s;
    }

}