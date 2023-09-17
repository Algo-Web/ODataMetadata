<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Core;

use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Helpers\ModelHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Annotations;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmValidCoreModelElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\Library\Annotations\EdmDirectValueAnnotationsManager;
use AlgoWeb\ODataMetadata\Library\EdmBinaryTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmCollectionType;
use AlgoWeb\ODataMetadata\Library\EdmCollectionTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmDecimalTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmElement;
use AlgoWeb\ODataMetadata\Library\EdmPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmSpatialTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmStringTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmTemporalTypeReference;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Provides predefined declarations relevant to EDM semantics.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmCoreModel extends EdmElement implements IModel, IEdmValidCoreModelElement
{
    use ModelHelpers;

    private static $instance = null;

    public static function getInstance(): EdmCoreModel
    {
        return self::$instance = self::$instance ?? new EdmCoreModel();
    }

    /**
     * @var EdmValidCoreModelPrimitiveType[]
     */
    private $primitiveTypes;

    private const EdmNamespace = 'Edm';
    /**
     * @var array<string, PrimitiveTypeKind>
     */
    private $primitiveTypeKinds = [];
    /**
     * @var array<PrimitiveTypeKind, EdmValidCoreModelPrimitiveType>
     */
    private $primitiveTypesByKind = [];
    /**
     * @var array<string, EdmValidCoreModelPrimitiveType>
     */
    private $primitiveTypeByName = [];
    /**
     * @var EdmDirectValueAnnotationsManager
     */
    private $annotationsManager;

    public function __construct()
    {
        $this->annotationsManager = new EdmDirectValueAnnotationsManager();
        $primitiveDouble          = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Double', PrimitiveTypeKind::Double());
        $primitiveSingle          = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Single', PrimitiveTypeKind::Single());

        $primitiveInt64 = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Int64', PrimitiveTypeKind::Int64());
        $primitiveInt32 = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Int32', PrimitiveTypeKind::Int32());
        $primitiveInt16 = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Int16', PrimitiveTypeKind::Int16());
        $primitiveSByte = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'SByte', PrimitiveTypeKind::SByte());
        $primitiveByte  = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Byte', PrimitiveTypeKind::Byte());

        $primitiveBoolean = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Boolean', PrimitiveTypeKind::Boolean());
        $primitiveGuid    = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Guid', PrimitiveTypeKind::Guid());

        $primitiveTime           = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Time', PrimitiveTypeKind::Time());
        $primitiveDateTime       = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'DateTime', PrimitiveTypeKind::DateTime());
        $primitiveDateTimeOffset = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'DateTimeOffset', PrimitiveTypeKind::DateTimeOffset());

        $primitiveDecimal = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Decimal', PrimitiveTypeKind::Decimal());

        $primitiveBinary = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Binary', PrimitiveTypeKind::Binary());
        $primitiveString = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'String', PrimitiveTypeKind::String());
        $primitiveStream = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Stream', PrimitiveTypeKind::Stream());

        $primitiveGeography                = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Geography', PrimitiveTypeKind::Geography());
        $primitiveGeographyPoint           = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeographyPoint', PrimitiveTypeKind::GeographyPoint());
        $primitiveGeographyLineString      = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeographyLineString', PrimitiveTypeKind::GeographyLineString());
        $primitiveGeographyPolygon         = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeographyPolygon', PrimitiveTypeKind::GeographyPolygon());
        $primitiveGeographyCollection      = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeographyCollection', PrimitiveTypeKind::GeographyCollection());
        $primitiveGeographyMultiPolygon    = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeographyMultiPolygon', PrimitiveTypeKind::GeographyMultiPolygon());
        $primitiveGeographyMultiLineString = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeographyMultiLineString', PrimitiveTypeKind::GeographyMultiLineString());
        $primitiveGeographyMultiPoint      = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeographyMultiPoint', PrimitiveTypeKind::GeographyMultiPoint());
        $primitiveGeometry                 = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'Geometry', PrimitiveTypeKind::Geometry());
        $primitiveGeometryPoint            = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeometryPoint', PrimitiveTypeKind::GeometryPoint());
        $primitiveGeometryLineString       = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeometryLineString', PrimitiveTypeKind::GeometryLineString());
        $primitiveGeometryPolygon          = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeometryPolygon', PrimitiveTypeKind::GeometryPolygon());
        $primitiveGeometryCollection       = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeometryCollection', PrimitiveTypeKind::GeometryCollection());
        $primitiveGeometryMultiPolygon     = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeometryMultiPolygon', PrimitiveTypeKind::GeometryMultiPolygon());
        $primitiveGeometryMultiLineString  = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeometryMultiLineString', PrimitiveTypeKind::GeometryMultiLineString());
        $primitiveGeometryMultiPoint       = new EdmValidCoreModelPrimitiveType(self::EdmNamespace, 'GeometryMultiPoint', PrimitiveTypeKind::GeometryMultiPoint());
        $this->primitiveTypes              = [
            $primitiveBinary,
            $primitiveBoolean,
            $primitiveByte,
            $primitiveDateTime,
            $primitiveDateTimeOffset,
            $primitiveDecimal,
            $primitiveDouble,
            $primitiveGuid,
            $primitiveInt16,
            $primitiveInt32,
            $primitiveInt64,
            $primitiveSByte,
            $primitiveSingle,
            $primitiveStream,
            $primitiveString,
            $primitiveTime,
            $primitiveGeography,
            $primitiveGeographyPoint,
            $primitiveGeographyLineString,
            $primitiveGeographyPolygon,
            $primitiveGeographyCollection,
            $primitiveGeographyMultiPolygon,
            $primitiveGeographyMultiLineString,
            $primitiveGeographyMultiPoint,
            $primitiveGeometry,
            $primitiveGeometryPoint,
            $primitiveGeometryLineString,
            $primitiveGeometryPolygon,
            $primitiveGeometryCollection,
            $primitiveGeometryMultiPolygon,
            $primitiveGeometryMultiLineString,
            $primitiveGeometryMultiPoint
        ];
        /** @var EdmValidCoreModelPrimitiveType $primitive */
        foreach ($this->primitiveTypes as $primitive) {
            EdmUtil::checkArgumentNull($primitive->getNamespace(), 'primitive->getNamespace');
            $this->primitiveTypeKinds[$primitive->getName()]                                     = $primitive->getPrimitiveKind();
            $this->primitiveTypeKinds[$primitive->getNamespace() . '.' . $primitive->getName()]  = $primitive->getPrimitiveKind();
            $this->primitiveTypesByKind[$primitive->getPrimitiveKind()->getValue()]              = $primitive;
            $this->primitiveTypeByName[$primitive->getNamespace() . '.' . $primitive->getName()] = $primitive;
        }
    }

    /**
     * @return string gets the namespace of this core model
     */
    public static function namespace(): string
    {
        return 'Edm';
    }

    /**
     * Gets the collection of schema elements that are contained in this model.
     *
     * @return ISchemaElement[]
     */
    public function getSchemaElements(): array
    {
        return $this->primitiveTypes;
    }

    /**
     * Gets the collection of vocabulary annotations that are contained in this model.
     *
     * @return Annotations\IVocabularyAnnotation[]
     */
    public function getVocabularyAnnotations(): array
    {
        return [];
    }

    /**
     * Gets the collection of models referred to by this model.
     *
     * @return IModel[]
     */
    public function getReferencedModels(): array
    {
        return [];
    }

    /**
     *  Gets the model's annotations manager.
     *
     * @return Annotations\IDirectValueAnnotationsManager
     */
    public function getDirectValueAnnotationsManager(): Annotations\IDirectValueAnnotationsManager
    {
        return $this->annotationsManager;
    }

    /**
     * Searches for an entity container with the given name in this model and returns null if no such entity container
     * exists.
     *
     * @param  string           $qualifiedName the name of the entity container being found
     * @return ISchemaType|null The requested entity container, or null if no such entity container exists
     */
    public function findDeclaredType(string $qualifiedName): ?ISchemaType
    {
        return array_key_exists($qualifiedName, $this->primitiveTypeByName) ? $this->primitiveTypeByName[$qualifiedName] : null;
    }

    /**
     * Searches for a type with the given name in this model and returns null if no such type exists.
     *
     * @param  string                $name the qualified name of the type being found
     * @return IEntityContainer|null the requested type, or null if no such type exists
     */
    public function findDeclaredEntityContainer(string $name): ?IEntityContainer
    {
        return null;
    }

    /**
     * Searches for functions with the given name in this model and returns an empty enumerable if no such function
     * exists.
     *
     * @param  string      $qualifiedName the qualified name of the function being found
     * @return IFunction[] a set of functions sharing the specified qualified name, or an empty enumerable if no
     *                                   such function exists
     */
    public function findDeclaredFunctions(string $qualifiedName): array
    {
        return [];
    }

    /**
     * Searches for a value term with the given name in this model and returns null if no such value term exists.
     *
     * @param  string          $qualifiedName the qualified name of the value term being found
     * @return IValueTerm|null the requested value term, or null if no such value term exists
     */
    public function findDeclaredValueTerm(string $qualifiedName): ?IValueTerm
    {
        return null;
    }

    /**
     *  Searches for vocabulary annotations specified by this model.
     *
     * @param  IVocabularyAnnotatable              $element the annotated element
     * @return Annotations\IVocabularyAnnotation[] the vocabulary annotations for the element
     */
    public function findDeclaredVocabularyAnnotations(IVocabularyAnnotatable $element): array
    {
        return [];
    }

    /**
     * Finds a list of types that derive directly from the supplied type.
     *
     * @param  IStructuredType   $baseType the base type that derived types are being searched for
     * @return IStructuredType[] a list of types from this model that derive directly from the given type
     */
    public function findDirectlyDerivedTypes(IStructuredType $baseType): array
    {
        return [];
    }

    /**
     * Gets a reference to a non-atomic collection type definition.
     *
     * @param  ITypeReference           $elementType type of elements in the collection
     * @return ICollectionTypeReference a new non-atomic collection type reference
     */
    public static function getCollection(ITypeReference $elementType): ICollectionTypeReference
    {
        return new EdmCollectionTypeReference(new EdmCollectionType($elementType), false);
    }

    private function getCoreModelPrimitiveType(PrimitiveTypeKind $kind): ?EdmValidCoreModelPrimitiveType
    {
        return array_key_exists(strval($kind), $this->primitiveTypesByKind) ?
            $this->primitiveTypesByKind[strval($kind)] : null;
    }

    /**
     * Gets primitive type by kind.
     *
     * @param  PrimitiveTypeKind   $kind kind of the primitive type
     * @return IPrimitiveType|null primitive type definition
     */
    public function getPrimitiveType(PrimitiveTypeKind $kind): ?IPrimitiveType
    {
        return $this->getCoreModelPrimitiveType($kind);
    }

    /**
     * Gets the PrimitiveTypeKind by the type name.
     *
     * @param  string            $typeName name of the type to look up
     * @return PrimitiveTypeKind PrimitiveTypeKind of the type.<
     */
    public function getPrimitiveTypeKind(string $typeName): PrimitiveTypeKind
    {
        return array_key_exists($typeName, $this->primitiveTypeKinds) ? $this->primitiveTypeKinds[$typeName] : PrimitiveTypeKind::None();
    }

    /**
     * Gets a reference to a primitive type of the specified kind.
     *
     * @param  PrimitiveTypeKind       $kind       primitive kind of the type reference being created
     * @param  bool                    $isNullable flag specifying if the referenced type should be nullable
     * @return IPrimitiveTypeReference a new primitive type reference
     */
    public function getPrimitive(PrimitiveTypeKind $kind, bool $isNullable): IPrimitiveTypeReference
    {
        $primitiveDefinition = $this->getCoreModelPrimitiveType($kind);
        if ($primitiveDefinition !== null) {
            return $primitiveDefinition->getPrimitiveTypeReference($isNullable);
        } else {
            throw new InvalidOperationException(StringConst::EdmPrimitive_UnexpectedKind());
        }
    }

    /**
     * Gets a reference to the Int16 primitive type definition.
     *
     * @param  bool                    $isNullable flag specifying if the referenced type should be nullable
     * @return IPrimitiveTypeReference a new primitive type reference
     */
    public function getInt16(bool $isNullable): IPrimitiveTypeReference
    {
        return new EdmPrimitiveTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::Int16()), $isNullable);
    }

    /**
     * Gets a reference to the Int32 primitive type definition.
     *
     * @param  bool                    $isNullable flag specifying if the referenced type should be nullable
     * @return IPrimitiveTypeReference a new primitive type reference
     */
    public function getInt32(bool $isNullable): IPrimitiveTypeReference
    {
        return new EdmPrimitiveTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::Int32()), $isNullable);
    }

    /**
     * Gets a reference to the Int64 primitive type definition.
     *
     * @param  bool                    $isNullable flag specifying if the referenced type should be nullable
     * @return IPrimitiveTypeReference a new primitive type reference
     */
    public function getInt64(bool $isNullable): IPrimitiveTypeReference
    {
        return new EdmPrimitiveTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::Int64()), $isNullable);
    }

    /**
     * Gets a reference to the Boolean primitive type definition.
     *
     * @param  bool                    $isNullable flag specifying if the referenced type should be nullable
     * @return IPrimitiveTypeReference a new primitive type reference
     */
    public function getBoolean(bool $isNullable): IPrimitiveTypeReference
    {
        return new EdmPrimitiveTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::Boolean()), $isNullable);
    }

    /**
     * Gets a reference to the Byte primitive type definition.
     *
     * @param  bool                    $isNullable flag specifying if the referenced type should be nullable
     * @return IPrimitiveTypeReference A new primitive type reference.<
     */
    public function getByte(bool $isNullable): IPrimitiveTypeReference
    {
        return new EdmPrimitiveTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::Byte()), $isNullable);
    }

    /**
     * Gets a reference to the SByte primitive type definition.
     *
     * @param  bool                    $isNullable flag specifying if the referenced type should be nullable
     * @return IPrimitiveTypeReference a new primitive type reference
     */
    public function getSByte(bool $isNullable): IPrimitiveTypeReference
    {
        return new EdmPrimitiveTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::SByte()), $isNullable);
    }

    /**
     * Gets a reference to the Guid primitive type definition.
     *
     * @param  bool                    $isNullable flag specifying if the referenced type should be nullable
     * @return IPrimitiveTypeReference a new primitive type reference
     */
    public function getGuid(bool $isNullable): IPrimitiveTypeReference
    {
        return new EdmPrimitiveTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::Guid()), $isNullable);
    }

    /**
     * Gets a reference to a datetime primitive type definition.
     *
     * @param  bool                   $isNullable flag specifying if the referenced type should be nullable
     * @return ITemporalTypeReference a new datetime type reference
     */
    public function getDateTime(bool $isNullable): ITemporalTypeReference
    {
        return new EdmTemporalTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::DateTime()), $isNullable);
    }

    /**
     * Gets a reference to a datetime with offset primitive type definition.
     *
     * @param  bool                   $isNullable flag specifying if the referenced type should be nullable
     * @return ITemporalTypeReference a new datetime with offset type reference
     */
    public function getDateTimeOffset(bool $isNullable): ITemporalTypeReference
    {
        return new EdmTemporalTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::DateTimeOffset()), $isNullable);
    }

    /**
     * Gets a reference to a time primitive type definition.
     *
     * @param  bool                   $isNullable flag specifying if the referenced type should be nullable
     * @return ITemporalTypeReference a new time type reference
     */
    public function getTime(bool $isNullable): ITemporalTypeReference
    {
        return new EdmTemporalTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::Time()), $isNullable);
    }

    /**
     * Gets a reference to a decimal primitive type definition.
     *
     * @param  int|null              $precision  precision of values of this type
     * @param  int|null              $scale      scale of values of this type
     * @param  bool                  $isNullable flag specifying if the referenced type should be nullable
     * @return IDecimalTypeReference a new decimal type reference
     */
    public function getDecimal(?int $precision, ?int $scale, bool $isNullable): IDecimalTypeReference
    {
        // Facet values may render this reference as semantically invalid, so can't return an IEdmValidCoreModelElement.
        return new EdmDecimalTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::Decimal()), $isNullable, $precision, $scale);
    }

    /**
     * Gets a reference to a single primitive type definition.
     *
     * @param  bool                    $isNullable flag specifying if the referenced type should be nullable
     * @return IPrimitiveTypeReference a new single type reference
     */
    public function getSingle(bool $isNullable): IPrimitiveTypeReference
    {
        return new EdmPrimitiveTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::Single()), $isNullable);
    }

    /**
     * Gets a reference to a double primitive type definition.
     *
     * @param  bool                    $isNullable flag specifying if the referenced type should be nullable
     * @return IPrimitiveTypeReference a new double type reference
     */
    public function getDouble(bool $isNullable): IPrimitiveTypeReference
    {
        return new EdmPrimitiveTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::Double()), $isNullable);
    }

    /**
     * Gets a reference to a stream primitive type definition.
     *
     * @param  bool                    $isNullable flag specifying if the referenced type should be nullable
     * @return IPrimitiveTypeReference a new stream type reference
     */
    public function getStream(bool $isNullable): IPrimitiveTypeReference
    {
        return new EdmPrimitiveTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::Stream()), $isNullable);
    }

    /**
     * Gets a reference to a temporal primitive type definition.
     *
     * @param  PrimitiveTypeKind      $kind       primitive kind of the type reference being created
     * @param  int|null               $precision  precision of values of this type
     * @param  bool                   $isNullable flag specifying if the referenced type should be nullable
     * @return ITemporalTypeReference a new temporal type reference
     */
    public function getTemporal(PrimitiveTypeKind $kind, ?int $precision, bool $isNullable): ITemporalTypeReference
    {
        if ($kind->isTemporal()) {
            return new EdmTemporalTypeReference($this->getCoreModelPrimitiveType($kind), $isNullable, $precision);
        }
        throw new InvalidOperationException(StringConst::EdmPrimitive_UnexpectedKind());
    }

    /**
     * Gets a reference to a binary primitive type definition.
     *
     * @param  bool                 $isUnbounded   flag specifying if max length is unbounded
     * @param  int|null             $maxLength     maximum length of the type
     * @param  bool|null            $isFixedLength flag specifying if the type will have a fixed length
     * @param  bool                 $isNullable    flag specifying if the referenced type should be nullable
     * @return IBinaryTypeReference a new binary type reference
     */
    public function getBinary(bool $isUnbounded, ?int $maxLength, ?bool $isFixedLength, bool $isNullable): IBinaryTypeReference
    {
        return new EdmBinaryTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::Binary()), $isNullable, $isUnbounded, $maxLength, $isFixedLength);
    }

    /**
     * Gets a reference to a spatial primitive type definition.
     *
     * @param  PrimitiveTypeKind     $kind                       primitive kind of the type reference being created
     * @param  int|null              $spatialReferenceIdentifier spatial Reference Identifier for the spatial type being created
     * @param  bool                  $isNullable                 flag specifying if the referenced type should be nullable
     * @return ISpatialTypeReference a new spatial type reference
     */
    public function getSpatial(PrimitiveTypeKind $kind, ?int $spatialReferenceIdentifier, bool $isNullable): ISpatialTypeReference
    {
        if ($kind->IsSpatial()) {
            return new EdmSpatialTypeReference($this->getCoreModelPrimitiveType($kind), $isNullable, $spatialReferenceIdentifier);
        }
        throw new InvalidOperationException(StringConst::EdmPrimitive_UnexpectedKind());
    }

    /**
     * Gets a reference to a string primitive type definition.
     *
     * @param  bool                 $isUnbounded   flag specifying if max length is the maximum allowable value
     * @param  int|null             $maxLength     maximum length of the type
     * @param  bool|null            $isFixedLength flag specifying if the type will have a fixed length
     * @param  bool|null            $isUnicode     flag specifying if the type should support unicode encoding
     * @param  string|null          $collation     string representing how data should be ordered
     * @param  bool                 $isNullable    flag specifying if the referenced type should be nullable
     * @return IStringTypeReference a new string type reference
     */
    public function getString(bool $isUnbounded, ?int $maxLength, ?bool $isFixedLength, ?bool $isUnicode, ?string $collation, bool $isNullable): IStringTypeReference
    {
        return new EdmStringTypeReference($this->getCoreModelPrimitiveType(PrimitiveTypeKind::String()), $isNullable, $isUnbounded, $maxLength, $isFixedLength, $isUnicode, $collation);
    }
}
