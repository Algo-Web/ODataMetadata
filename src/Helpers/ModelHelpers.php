<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Asserts;
use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\Helpers\AssociationAnnotations;
use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\Helpers\AssociationSetAnnotations;
use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\IModelHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotationsManager;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\Internal\RegistrationHelper;
use AlgoWeb\ODataMetadata\Version;
use SplObjectStorage;

/**
 * Trait ModelHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait ModelHelpers
{
    use ModelHelpersVocabularyAnnotation;

    public function getNamespaceAliases(): array
    {
        /** @var IModel $this */
        /** @var array|null $result */
        $result = $this->getAnnotationValue(
            'array',
            $this,
            EdmConstants::InternalUri,
            CsdlConstants::NamespaceAliasAnnotation
        );
        return $result ?? [];
    }

    // This internal method exists so we can get a consistent view of the mappings through the entire serialization
    // process. Otherwise, changes to the dictionary during serialization would result in an invalid or inconsistent
    // output.

    public function getAnnotationValue(
        string $typeof,
        IEdmElement $element,
        string $namespaceName = null,
        string $localName = null
    ) {
        $namespaceName = $namespaceName ?? EdmConstants::InternalUri;
        $localName     = $localName ?? Helpers::classNameToLocalName($typeof);
        return Helpers::annotationValue(
            $typeof,
            $this->getDirectValueAnnotationsManager()->getAnnotationValue(
                $element,
                $namespaceName,
                $localName
            )
        );
    }

    abstract public function getDirectValueAnnotationsManager(): IDirectValueAnnotationsManager;

    /**
     * Searches for an entity container with the given name in this model and all referenced models and returns null
     * if no such entity container exists.
     *
     * @param  string           $qualifiedName the qualified name of the entity container being found
     * @return IEntityContainer the requested entity container, or null if no such entity container exists
     */
    public function findEntityContainer(string $qualifiedName): ?IEntityContainer
    {
        EdmUtil::checkArgumentNull($qualifiedName, "$qualifiedName");

        return $this->findAcrossModels(
            $qualifiedName,
            self::entityContainerFinder(),
            [RegistrationHelper::class, 'createAmbiguousEntityContainerBinding']
        );
    }

    private function findAcrossModels(string $qualifiedName, callable $finder, callable $ambiguousCreator)
    {
        $model = $this;
        Asserts::assertSignatureMatches(
            function (/** @scrutinizer ignore-unused */IModel $model, /** @scrutinizer ignore-unused */string $qualifiedName) {
            },
            $finder,
            '$finder'
        );
        Asserts::assertSignatureMatches(
            function (/** @scrutinizer ignore-unused */$candidate, /** @scrutinizer ignore-unused */$fromReference) {
            },
            $ambiguousCreator,
            '$ambiguousCreator'
        );
        $candidate = $finder($model, $qualifiedName);
        foreach ($model->getReferencedModels() as $reference) {
            $fromReference = $finder($reference, $qualifiedName);
            if ($fromReference !== null) {
                $candidate = $candidate === null ? $fromReference : $ambiguousCreator($candidate, $fromReference);
            }
        }
        return $candidate;
    }

    /**
     * @return IModel[] gets the collection of models referred to by this model
     */
    abstract public function getReferencedModels(): array;

    public static function entityContainerFinder(): callable
    {
        return function (IModel $model, string $qualifiedName): ?IEntityContainer {
            return $model->findDeclaredEntityContainer($qualifiedName);
        };
    }

    /**
     * Searches for a value term with the given name in this model and all referenced models and returns null if no
     * such value term exists.
     *
     * @param  string     $qualifiedName the qualified name of the value term being found
     * @return IValueTerm the requested value term, or null if no such value term exists
     */
    public function findValueTerm(string $qualifiedName): ?IValueTerm
    {
        EdmUtil::checkArgumentNull($qualifiedName, 'qualifiedName');

        return $this->findAcrossModels(
            $qualifiedName,
            self::valueTermFinder(),
            [RegistrationHelper::class, 'createAmbiguousValueTermBinding']
        );
    }

    private static function valueTermFinder(): callable
    {
        return function (IModel $model, string $qualifiedName): ?IValueTerm {
            return $model->findDeclaredValueTerm($qualifiedName);
        };
    }

    /**
     * Searches for functions with the given name in this model and all referenced models and returns an empty
     * enumerable if no such functions exist.
     *
     * @param  string      $qualifiedName the qualified name of the functions being found
     * @return IFunction[] the requested functions
     */
    public function findFunctions(string $qualifiedName): array
    {
        EdmUtil::checkArgumentNull($qualifiedName, 'qualifiedName');

        return $this->findAcrossModels($qualifiedName, self::functionsFinder(), self::mergeFunctions()) ?? [];
    }

    private static function functionsFinder(): callable
    {
        return function (IModel $model, string $qualifiedName): array {
            return $model->findDeclaredFunctions($qualifiedName);
        };
    }

    private static function mergeFunctions(): callable
    {
        return function (array $f1, array $f2): array {
            return array_merge($f1, $f2);
        };
    }

    /**
     * Gets the value for the EDM version of the Model.
     *
     * @return Version the version
     */
    public function getEdmVersion(): ?Version
    {
        /** @var IModel $this */
        return $this->getAnnotationValue(
            Version::class,
            $this,
            EdmConstants::InternalUri,
            EdmConstants::EdmVersionAnnotation
        );
    }

    /**
     * Sets a value of EDM version attribute of the Model.
     *
     * @param Version $version the version
     */
    public function setEdmVersion(Version $version)
    {
        /** @var IModel $this */
        $this->setAnnotationValue($this, EdmConstants::InternalUri, EdmConstants::EdmVersionAnnotation, $version);
    }

    /**
     * Sets an annotation value for an EDM element. If the value is null, no annotation is added and an existing
     * annotation with the same name is removed.
     *
     * @param IEdmElement  $element       the annotated element
     * @param string       $namespaceName namespace that the annotation belongs to
     * @param string       $localName     name of the annotation within the namespace
     * @param mixed|object $value         value of the new annotation
     */
    public function setAnnotationValue(IEdmElement $element, string $namespaceName, string $localName, $value)
    {
        $this->getDirectValueAnnotationsManager()->setAnnotationValue($element, $namespaceName, $localName, $value);
    }

    /**
     * Gets the value for the EDMX version of the model.
     *
     * @return Version the version
     */
    public function getEdmxVersion(): ?Version
    {
        /** @var IModel $this */
        return $this->getAnnotationValue(
            Version::class,
            $this,
            EdmConstants::InternalUri,
            CsdlConstants::EdmxVersionAnnotation
        );
    }

    /**
     *  Sets a value of EDMX version attribute of the model.
     *
     * @param Version $version the version
     */
    public function setEdmxVersion(Version $version): void
    {
        /** @var IModel $this */
        $this->setAnnotationValue($this, EdmConstants::InternalUri, CsdlConstants::EdmxVersionAnnotation, $version);
    }

    /**
     * Sets a value for the DataServiceVersion attribute in an EDMX artifact.
     *
     * @param Version $version the value of the attribute
     */
    public function setDataServiceVersion(Version $version): void
    {
        /** @var IModel $this */
        $this->setAnnotationValue($this, EdmConstants::InternalUri, EdmConstants::DataServiceVersion, $version);
    }

    /**
     * Gets the value for the DataServiceVersion attribute used during EDMX serialization.
     *
     * @return Version value of the attribute
     */
    public function getDataServiceVersion(): ?Version
    {
        /** @var IModel $this */
        return $this->getAnnotationValue(
            Version::class,
            $this,
            EdmConstants::InternalUri,
            EdmConstants::DataServiceVersion
        );
    }

    /**
     * Sets a value for the MaxDataServiceVersion attribute in an EDMX artifact.
     *
     * @param Version $version the value of the attribute
     */
    public function setMaxDataServiceVersion(Version $version): void
    {
        /** @var IModel $this */
        $this->setAnnotationValue($this, EdmConstants::InternalUri, EdmConstants::MaxDataServiceVersion, $version);
    }

    /**
     * Gets the value for the MaxDataServiceVersion attribute used during EDMX serialization.
     *
     * @return Version value of the attribute
     */
    public function getMaxDataServiceVersion(): ?Version
    {
        /** @var IModel $this */
        return $this->getAnnotationValue(
            Version::class,
            $this,
            EdmConstants::InternalUri,
            EdmConstants::MaxDataServiceVersion
        );
    }

    /**
     * Sets an annotation on the IEdmModel to notify the serializer of preferred prefix mappings for xml namespaces.
     *
     * @param array $mappings xmlNamespaceManage containing mappings between namespace prefixes and xml namespaces
     */
    public function setNamespacePrefixMappings(array $mappings): void
    {
        /** @var IModel $this */
        $this->setAnnotationValue(
            $this,
            EdmConstants::InternalUri,
            CsdlConstants::NamespacePrefixAnnotation,
            $mappings
        );
    }

    /**
     * Gets the preferred prefix mappings for xml namespaces from an IEdmModel.
     *
     * @return array namespace prefixes that exist on the model
     */
    public function getNamespacePrefixMappings(): array
    {
        /** @var IModel $this */
        /** @var array|null $result */
        $result = $this->getAnnotationValue(
            'array',
            $this,
            EdmConstants::InternalUri,
            CsdlConstants::NamespacePrefixAnnotation
        );

        return $result ?? [];
    }

    /**
     * Sets the name used for the association end serialized for a navigation property.
     *
     * @param INavigationProperty $property    the navigation property
     * @param string              $association the association end name
     */
    public function setAssociationEndName(INavigationProperty $property, string $association): void
    {
        $this->setAnnotationValue(
            $property,
            EdmConstants::InternalUri,
            CsdlConstants::AssociationEndNameAnnotation,
            $association
        );
    }

    /**
     * Gets the name used for the association end serialized for a navigation property.
     *
     * @param  INavigationProperty $property the navigation property
     * @return string              the association end name
     */
    public function getAssociationEndName(INavigationProperty $property): string
    {
        $property->populateCaches();
        /** @var string|null $result */
        $result = $this->getAnnotationValue(
            'string',
            $property,
            EdmConstants::InternalUri,
            CsdlConstants::AssociationEndNameAnnotation
        );

        return $result ?? ($property->getPartner()->getName() ?? '');
    }

    /**
     * Gets the fully-qualified name used for the association serialized for a navigation property.
     *
     * @param  INavigationProperty $property the navigation property
     * @return string              the fully-qualified association name
     */
    public function getAssociationFullName(INavigationProperty $property): string
    {
        $property->populateCaches();
        return $this->getAssociationNamespace($property) . '.' . $this->getAssociationName($property);
    }

    /**
     * Gets the namespace used for the association serialized for a navigation property.
     *
     * @param  INavigationProperty $property the navigation property
     * @return string              the association namespace
     */
    public function getAssociationNamespace(INavigationProperty $property): string
    {
        $model = $this;
        assert($model instanceof IModel);

        $property->populateCaches();
        $associationNamespace = $model->getAnnotationValue(
            '?string',
            $property,
            EdmConstants::InternalUri,
            CsdlConstants::AssociationNamespaceAnnotation
        );
        if ($associationNamespace == null) {
            $associationNamespace = $property->getPrimary()->declaringEntityType()->getNamespace();
        }

        return $associationNamespace;
    }

    /**
     * Gets the name used for the association serialized for a navigation property.
     *
     * @param  INavigationProperty $property the navigation property
     * @return string              the association name
     */
    public function getAssociationName(INavigationProperty $property): string
    {
        $model = $this;
        assert($model instanceof IModel);

        $property->populateCaches();
        $associationName = $model->getAnnotationValue(
            '?string',
            $property,
            EdmConstants::InternalUri,
            CsdlConstants::AssociationNameAnnotation
        );
        if ($associationName == null) {
            $fromPrincipal = $property->getPrimary();
            $toPrincipal   = $fromPrincipal->getPartner();

            $associationName =
                Helpers::getQualifiedAndEscapedPropertyName($toPrincipal) .
                Helpers::AssociationNameEscapeChar .
                Helpers::getQualifiedAndEscapedPropertyName($fromPrincipal);
        }

        return $associationName;
    }

    public function findType(string $qualifiedName): ?ISchemaType
    {
        $findTypeMethod = self::findTypec();
        /** @var IModel $this */
        return Helpers::findAcrossModels(
            $this,
            $qualifiedName,
            $findTypeMethod,
            [RegistrationHelper::class, 'CreateAmbiguousTypeBinding']
        );
    }

    private static function findTypec(): callable
    {
        return function (IModel $model, string $qualifiedName): ?ISchemaType {
            return $model->findDeclaredType($qualifiedName);
        };
    }

    /**
     * Sets the name used for the association serialized for a navigation property.
     *
     * @param INavigationProperty $property        the navigation property
     * @param string              $associationName the association name
     */
    public function setAssociationName(INavigationProperty $property, string $associationName): void
    {
        $model = $this;
        assert($model instanceof IModel);

        $model->setAnnotationValue(
            $property,
            EdmConstants::InternalUri,
            CsdlConstants::AssociationNameAnnotation,
            $associationName
        );
    }

    /**
     * Sets the namespace used for the association serialized for a navigation property.
     *
     * @param INavigationProperty $property             the navigation property
     * @param string              $associationNamespace the association namespace
     */
    public function setAssociationNamespace(INavigationProperty $property, string $associationNamespace): void
    {
        $model = $this;
        assert($model instanceof IModel);

        $model->setAnnotationValue(
            $property,
            EdmConstants::InternalUri,
            CsdlConstants::AssociationNamespaceAnnotation,
            $associationNamespace
        );
    }

    /**
     * Sets the name used for the association set serialized for a navigation property of an entity set.
     *
     * @param IEntitySet          $entitySet      The entity set
     * @param INavigationProperty $property       the navigation property
     * @param string              $associationSet the association set name
     */
    public function setAssociationSetName(
        IEntitySet $entitySet,
        INavigationProperty $property,
        string $associationSet
    ): void {
        $model = $this;
        assert($model instanceof IModel);
        $navigationPropertyMappings = $model->getAnnotationValue(
            'SplObjectStorage',
            $entitySet,
            EdmConstants::InternalUri,
            CsdlConstants::AssociationSetNameAnnotation
        );
        if ($navigationPropertyMappings == null) {
            $navigationPropertyMappings = new SplObjectStorage();
            $model->setAnnotationValue(
                $entitySet,
                EdmConstants::InternalUri,
                CsdlConstants::AssociationSetNameAnnotation,
                $navigationPropertyMappings
            );
        }

        $navigationPropertyMappings->offsetSet($property, $associationSet);
    }

    /**
     * Gets the name used for the association set serialized for a navigation property of an entity set.
     *
     * @param  IEntitySet          $entitySet the entity set
     * @param  INavigationProperty $property  the navigation property
     * @return string              the association set name
     */
    public function getAssociationSetName(IEntitySet $entitySet, INavigationProperty $property): string
    {
        $model = $this;
        assert($model instanceof IModel);

        $navigationPropertyMappings = $model->getAnnotationValue(
            SplObjectStorage::class,
            $entitySet,
            EdmConstants::InternalUri,
            CsdlConstants::AssociationSetNameAnnotation
        );
        assert($navigationPropertyMappings instanceof SplObjectStorage || $navigationPropertyMappings === null);
        if ($navigationPropertyMappings !== null && $navigationPropertyMappings->offsetExists($property)) {
            $associationSetName = $navigationPropertyMappings->offsetGet($property);
        } else {
            $associationSetName = $model->getAssociationName($property) . 'Set';
        }

        return $associationSetName;
    }

    /**
     * Gets the annotations associated with the association serialized for a navigation target of an entity set.
     *
     * @param IEntitySet          $entitySet       the entity set
     * @param INavigationProperty $property        the navigation property
     * @param iterable            $annotations     the association set annotations
     * @param iterable            $end1Annotations the annotations for association set end 1
     * @param iterable            $end2Annotations the annotations for association set end 2
     */
    public function getAssociationSetAnnotations(
        IEntitySet $entitySet,
        INavigationProperty $property,
        iterable &$annotations = [],
        iterable &$end1Annotations = [],
        iterable &$end2Annotations = []
    ): void {
        /** @var SplObjectStorage $navigationPropertyMappings */
        $navigationPropertyMappings = $this->getAnnotationValue(
            SplObjectStorage::class,
            $entitySet,
            EdmConstants::InternalUri,
            CsdlConstants::AssociationSetAnnotationsAnnotation
        );
        if ($navigationPropertyMappings != null && $navigationPropertyMappings->offsetExists($property)) {
            /** @var AssociationSetAnnotations $associationSetAnnotations */
            $associationSetAnnotations = $navigationPropertyMappings[$property];
            $annotations               = $associationSetAnnotations->Annotations ?? [];
            $end1Annotations           = $associationSetAnnotations->End1Annotations ?? [];
            $end2Annotations           = $associationSetAnnotations->End2Annotations ?? [];
        } else {
            $empty           = [];
            $annotations     = $empty;
            $end1Annotations = $empty;
            $end2Annotations = $empty;
        }
    }

    /**
     * Gets the annotations associated with the association serialized for a navigation property.
     *
     * @param INavigationProperty $property              the navigation property
     * @param iterable            $annotations           the association annotations
     * @param iterable            $end1Annotations       the annotations for association end 1
     * @param iterable            $end2Annotations       the annotations for association end 2
     * @param iterable            $constraintAnnotations the annotations for the referential constraint
     */
    public function getAssociationAnnotations(
        INavigationProperty $property,
        iterable &$annotations = [],
        iterable &$end1Annotations = [],
        iterable &$end2Annotations = [],
        iterable &$constraintAnnotations = []
    ) {
        $property->populateCaches();
        $associationAnnotations = $this->getAnnotationValue(
            AssociationAnnotations::class,
            $property,
            EdmConstants::InternalUri,
            CsdlConstants::AssociationAnnotationsAnnotation
        );
        if ($associationAnnotations != null) {
            $annotations           = $associationAnnotations->Annotations ?? [];
            $end1Annotations       = $associationAnnotations->End1Annotations ?? [];
            $end2Annotations       = $associationAnnotations->End2Annotations ?? [];
            $constraintAnnotations = $associationAnnotations->ConstraintAnnotations ?? [];
        } else {
            $empty                 = [];
            $annotations           = $empty;
            $end1Annotations       = $empty;
            $end2Annotations       = $empty;
            $constraintAnnotations = $empty;
        }
    }

    /**
     * Finds a list of types that derive from the supplied type directly or indirectly, and across models.
     *
     * @param  IStructuredType $baseType the base type that derived types are being searched for
     * @return array           a list of types that derive from the type
     */
    public function findAllDerivedTypes(IStructuredType $baseType): array
    {
        $result = [];
        if ($baseType instanceof ISchemaElement) {
            $this->derivedFrom($baseType, new SplObjectStorage(), $result);
        }

        return $result;
    }

    private function derivedFrom(IStructuredType $baseType, SplObjectStorage $visited, array &$derivedTypes): void
    {
        if (!$visited->offsetExists($this)) {
            $visited->offsetSet($this, true);
            $candidates = $this->findDirectlyDerivedTypes($baseType);
            if ($candidates != null && count($candidates) > 0) {
                foreach ($candidates as $derivedType) {
                    $derivedTypes[] = $derivedType;
                    $this->derivedFrom($derivedType, $visited, $derivedTypes);
                }
            }

            foreach ($this->getReferencedModels() as $referenced) {
                $candidates = $referenced->findDirectlyDerivedTypes($baseType);
                if ($candidates != null && count($candidates) > 0) {
                    foreach ($candidates as $derivedType) {
                        $derivedTypes[] = $derivedType;
                        $this->derivedFrom($derivedType, $visited, $derivedTypes);
                    }
                }
            }
        }
    }

    /**
     * Finds a list of types that derive directly from the supplied type.
     *
     * @param  IStructuredType   $baseType the base type that derived types are being searched for
     * @return IStructuredType[] a list of types from this model that derive directly from the given type
     */
    abstract public function findDirectlyDerivedTypes(IStructuredType $baseType): array;
}
