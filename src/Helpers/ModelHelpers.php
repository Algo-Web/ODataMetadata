<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\Helpers\AssociationAnnotations;
use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\Helpers\AssociationSetAnnotations;
use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Internal\RegistrationHelper;
use AlgoWeb\ODataMetadata\Version;
use SplObjectStorage;

/**
 * Trait ModelHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 * @mixin IModel
 */
trait ModelHelpers
{
    public function GetAnnotationValue(string $typeof, IEdmElement $element, string $namespaceName = null, string $localName = null)
    {
        $namespaceName = $namespaceName ?? EdmConstants::InternalUri;
        $localName     = $localName ?? Helpers::classNameToLocalName($typeof);
        return Helpers::AnnotationValue($typeof, $this->getDirectValueAnnotationsManager()->getAnnotationValue($element, $namespaceName, $localName));
    }
    // This internal method exists so we can get a consistent view of the mappings through the entire serialization process.
    // Otherwise, changes to the dictionary durring serialization would result in an invalid or inconsistent output.
    public function GetNamespaceAliases(): array
    {
        return $this->GetAnnotationValue('array', $this, EdmConstants::InternalUri, CsdlConstants::NamespaceAliasAnnotation) ??[];
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
    public function SetAnnotationValue(IEdmElement $element, string $namespaceName, string $localName, $value)
    {
        $this->getDirectValueAnnotationsManager()->setAnnotationValue($element, $namespaceName, $localName, $value);
    }

    private static function findEntityContainer(): callable
    {
        return function (IModel $model, string $qualifiedName): IEntityContainer {
            return $model->findDeclaredEntityContainer($qualifiedName);
        };
    }

    private static function findTypec(): callable
    {
        return function (IModel $model, string $qualifiedName): ISchemaType {
            return $model->findDeclaredType($qualifiedName);
        };
    }

    private static function findFunctions(): callable
    {
        return function (IModel $model, string $qualifiedName): array {
            return $model->findDeclaredFunctions($qualifiedName);
        };
    }
    private static function findValueTerm(): callable
    {
        return function (IModel $model, string $qualifiedName): IValueTerm {
            return $model->findDeclaredValueTerm($qualifiedName);
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
    public function GetEdmVersion(): ?Version
    {
        return $this->GetAnnotationValue(Version::class, $this, EdmConstants::InternalUri, EdmConstants::EdmVersionAnnotation);
    }

    /**
     * Sets a value of EDM version attribute of the Model.
     *
     * @param Version $version the version
     */
    public function SetEdmVersion(Version $version)
    {
        $this->SetAnnotationValue($this, EdmConstants::InternalUri, EdmConstants::EdmVersionAnnotation, $version);
    }

    /**
     * Gets the value for the EDMX version of the model.
     *
     * @return Version the version
     */
    public function GetEdmxVersion(): ?Version
    {
        return $this->GetAnnotationValue(Version::class, $this, EdmConstants::InternalUri, CsdlConstants::EdmxVersionAnnotation);
    }

    /**
     *  Sets a value of EDMX version attribute of the model.
     *
     * @param Version $version the version
     */
    public function SetEdmxVersion(Version $version): void
    {
        $this->SetAnnotationValue($this, EdmConstants::InternalUri, CsdlConstants::EdmxVersionAnnotation, $version);
    }

    /**
     * Sets a value for the DataServiceVersion attribute in an EDMX artifact.
     *
     * @param Version $version the value of the attribute
     */
    public function SetDataServiceVersion(Version $version): void
    {
        $this->SetAnnotationValue($this, EdmConstants::InternalUri, EdmConstants::DataServiceVersion, $version);
    }

    /**
     * Gets the value for the DataServiceVersion attribute used during EDMX serialization.
     *
     * @return Version value of the attribute
     */
    public function GetDataServiceVersion(): ?Version
    {
        return $this->GetAnnotationValue(Version::class, $this, EdmConstants::InternalUri, EdmConstants::DataServiceVersion);
    }

    /**
     * Sets a value for the MaxDataServiceVersion attribute in an EDMX artifact.
     *
     * @param Version $version the value of the attribute
     */
    public function SetMaxDataServiceVersion(Version $version): void
    {
        $this->SetAnnotationValue($this, EdmConstants::InternalUri, EdmConstants::MaxDataServiceVersion, $version);
    }

    /**
     * Gets the value for the MaxDataServiceVersion attribute used during EDMX serialization.
     *
     * @return Version value of the attribute
     */
    public function GetMaxDataServiceVersion(): ?Version
    {
        return $this->GetAnnotationValue(Version::class, $this, EdmConstants::InternalUri, EdmConstants::MaxDataServiceVersion);
    }
    /**
     * Sets an annotation on the IEdmModel to notify the serializer of preferred prefix mappings for xml namespaces.
     *
     * @param array $mappings xmlNamespaceManage containing mappings between namespace prefixes and xml namespaces
     */
    public function SetNamespacePrefixMappings(array $mappings): void
    {
        $this->SetAnnotationValue($this, EdmConstants::InternalUri, CsdlConstants::NamespacePrefixAnnotation, $mappings);
    }

    /**
     * Gets the preferred prefix mappings for xml namespaces from an IEdmModel.
     *
     * @return array namespace prefixes that exist on the model
     */
    public function GetNamespacePrefixMappings(): array
    {
        return $this->GetAnnotationValue('array', $this, EdmConstants::InternalUri, CsdlConstants::NamespacePrefixAnnotation)??[];
    }


    /**
     * Sets the name used for the association end serialized for a navigation property.
     *
     * @param INavigationProperty $property    the navigation property
     * @param string              $association the association end name
     */
    public function SetAssociationEndName(INavigationProperty $property, string $association): void
    {
        $this->SetAnnotationValue($property, EdmConstants::InternalUri, CsdlConstants::AssociationEndNameAnnotation, $association);
    }

    /**
     * Gets the name used for the association end serialized for a navigation property.
     *
     * @param  INavigationProperty $property the navigation property
     * @return string              the association end name
     */
    public function GetAssociationEndName(INavigationProperty $property): string
    {
        $property->PopulateCaches();
        return $this->GetAnnotationValue('string', $property, EdmConstants::InternalUri, CsdlConstants::AssociationEndNameAnnotation) ?? $property->getPartner()->getName();
    }

    /**
     * Gets the fully-qualified name used for the association serialized for a navigation property.
     *
     * @param  INavigationProperty $property the navigation property
     * @return string              the fully-qualified association name
     */
    public function GetAssociationFullName(INavigationProperty $property): string
    {
        $property->PopulateCaches();
        return $this->GetAssociationNamespace($property) . '.' . $this->GetAssociationName($property);
    }
    public function FindType(string $qualifiedName): ISchemaType
    {
        return Helpers::FindAcrossModels($this, $qualifiedName, self::findTypec(), [RegistrationHelper::class, 'CreateAmbiguousTypeBinding']);
    }

    /**
     * Sets the name used for the association serialized for a navigation property.
     *
     * @param INavigationProperty $property        the navigation property
     * @param string              $associationName the association name
     */
    public function SetAssociationName(INavigationProperty $property, string $associationName): void
    {
        $model = $this;
        assert($model instanceof IModel);

        $model->SetAnnotationValue($property, EdmConstants::InternalUri, CsdlConstants::AssociationNameAnnotation, $associationName);
    }

    /**
     * Gets the name used for the association serialized for a navigation property.
     *
     * @param  INavigationProperty $property the navigation property
     * @return string              the association name
     */
    public function GetAssociationName(INavigationProperty $property): string
    {
        $model = $this;
        assert($model instanceof IModel);

        $property->PopulateCaches();
        $associationName = $model->GetAnnotationValue('?string', $property, EdmConstants::InternalUri, CsdlConstants::AssociationNameAnnotation);
        if ($associationName == null) {
            $fromPrincipal = $property->GetPrimary();
            $toPrincipal   = $fromPrincipal->getPartner();

            $associationName =
                Helpers::GetQualifiedAndEscapedPropertyName($toPrincipal) .
                Helpers::AssociationNameEscapeChar .
                Helpers::GetQualifiedAndEscapedPropertyName($fromPrincipal);
        }

        return $associationName;
    }

    /**
     * Sets the namespace used for the association serialized for a navigation property.
     *
     * @param INavigationProperty $property             the navigation property
     * @param string              $associationNamespace the association namespace
     */
    public function SetAssociationNamespace(INavigationProperty $property, string $associationNamespace): void
    {
        $model = $this;
        assert($model instanceof IModel);

        $model->SetAnnotationValue($property, EdmConstants::InternalUri, CsdlConstants::AssociationNamespaceAnnotation, $associationNamespace);
    }

    /**
     * Gets the namespace used for the association serialized for a navigation property.
     *
     * @param  INavigationProperty $property the navigation property
     * @return string              the association namespace
     */
    public function GetAssociationNamespace(INavigationProperty $property): string
    {
        $model = $this;
        assert($model instanceof IModel);

        $property->PopulateCaches();
        $associationNamespace = $model->GetAnnotationValue('?string', $property, EdmConstants::InternalUri, CsdlConstants::AssociationNamespaceAnnotation);
        if ($associationNamespace == null) {
            $associationNamespace = $property->GetPrimary()->DeclaringEntityType()->getNamespace();
        }

        return $associationNamespace;
    }

    /**
     * Sets the name used for the association set serialized for a navigation property of an entity set.
     *
     * @param IEntitySet          $entitySet      The entity set
     * @param INavigationProperty $property       the navigation property
     * @param string              $associationSet the association set name
     */
    public function SetAssociationSetName(IEntitySet $entitySet, INavigationProperty $property, string $associationSet): void
    {
        $model = $this;
        assert($model instanceof IModel);
        $navigationPropertyMappings = $model->GetAnnotationValue('SplObjectStorage', $entitySet, EdmConstants::InternalUri, CsdlConstants::AssociationSetNameAnnotation);
        if ($navigationPropertyMappings == null) {
            $navigationPropertyMappings = new SplObjectStorage();
            $model->SetAnnotationValue($entitySet, EdmConstants::InternalUri, CsdlConstants::AssociationSetNameAnnotation, $navigationPropertyMappings);
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
    public function GetAssociationSetName(IEntitySet $entitySet, INavigationProperty $property): string
    {
        $model = $this;
        assert($model instanceof IModel);

        $navigationPropertyMappings = $model->GetAnnotationValue(SplObjectStorage::class, $entitySet, EdmConstants::InternalUri, CsdlConstants::AssociationSetNameAnnotation);
        assert($navigationPropertyMappings instanceof SplObjectStorage || $navigationPropertyMappings === null);
        if ($navigationPropertyMappings !== null && $navigationPropertyMappings->offsetExists($property)) {
            $associationSetName = $navigationPropertyMappings->offsetGet($property) ;
        } else {
            $associationSetName = $model->GetAssociationName($property) . 'Set';
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
    public function GetAssociationSetAnnotations(IEntitySet $entitySet, INavigationProperty $property, iterable &$annotations = [], iterable &$end1Annotations = [], iterable &$end2Annotations = []): void
    {
        /**
         * @var SplObjectStorage $navigationPropertyMappings;
         */
        $navigationPropertyMappings = $this->GetAnnotationValue(SplObjectStorage::class, $entitySet, EdmConstants::InternalUri, CsdlConstants::AssociationSetAnnotationsAnnotation);
        if ($navigationPropertyMappings != null && $navigationPropertyMappings->offsetExists($property)) {
            /**
             * @var AssociationSetAnnotations $associationSetAnnotations
             */
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
    public function GetAssociationAnnotations(INavigationProperty $property, iterable &$annotations = [], iterable &$end1Annotations = [], iterable &$end2Annotations = [], iterable &$constraintAnnotations = [])
    {
        $property->PopulateCaches();
        $associationAnnotations = $this->GetAnnotationValue(AssociationAnnotations::class, $property, EdmConstants::InternalUri, CsdlConstants::AssociationAnnotationsAnnotation);
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
    public function FindAllDerivedTypes(IStructuredType $baseType): array
    {
        $result = [];
        if ($baseType instanceof ISchemaElement) {
            $this->DerivedFrom($baseType, new SplObjectStorage(), $result);
        }

        return $result;
    }


    private function DerivedFrom(IStructuredType $baseType, SplObjectStorage $visited, array &$derivedTypes): void
    {
        if (!$visited->offsetExists($this)) {
            $visited->offsetSet($this, true);
            $candidates = $this->findDirectlyDerivedTypes($baseType);
            if ($candidates != null && count($candidates) > 0) {
                foreach ($candidates as $derivedType) {
                    $derivedTypes[] = $derivedType;
                    $this->DerivedFrom($derivedType, $visited, $derivedTypes);
                }
            }

            foreach ($this->getReferencedModels() as $referenced) {
                $candidates = $referenced->findDirectlyDerivedTypes($baseType);
                if ($candidates != null && count($candidates) > 0) {
                    foreach ($candidates as $derivedType) {
                        $derivedTypes[] = $derivedType;
                        $this->DerivedFrom($derivedType, $visited, $derivedTypes);
                    }
                }
            }
        }
    }
}