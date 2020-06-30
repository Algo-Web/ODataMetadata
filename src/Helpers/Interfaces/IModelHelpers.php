<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Version;

/**
 * Trait ModelHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IModelHelpers
{
    public function GetAnnotationValue(string $typeof, IEdmElement $element, string $namespaceName = null, string $localName = null);

    public function GetNamespaceAliases(): array;

    /**
     * Sets an annotation value for an EDM element. If the value is null, no annotation is added and an existing
     * annotation with the same name is removed.
     *
     * @param IEdmElement $element the annotated element
     * @param string $namespaceName namespace that the annotation belongs to
     * @param string $localName name of the annotation within the namespace
     * @param mixed|object $value value of the new annotation
     */
    public function SetAnnotationValue(IEdmElement $element, string $namespaceName, string $localName, $value);

    /**
     * Searches for an entity container with the given name in this model and all referenced models and returns null
     * if no such entity container exists.
     *
     * @param string $qualifiedName the qualified name of the entity container being found
     * @return IEntityContainer the requested entity container, or null if no such entity container exists
     */
    public function FindEntityContainer(string $qualifiedName): ?IEntityContainer;

    /**
     * Searches for a value term with the given name in this model and all referenced models and returns null if no
     * such value term exists.
     *
     * @param string $qualifiedName the qualified name of the value term being found
     * @return IValueTerm the requested value term, or null if no such value term exists
     */
    public function FindValueTerm(string $qualifiedName): ?IValueTerm;

    /***
     * Searches for functions with the given name in this model and all referenced models and returns an empty
     * enumerable if no such functions exist.
     *
     * @param string $qualifiedName The qualified name of the functions being found.
     * @return IFunction[] The requested functions.
     */
    public function FindFunctions(string $qualifiedName): array;

    /**
     * Gets the value for the EDM version of the Model.
     *
     * @return Version the version
     */
    public function GetEdmVersion(): ?Version;

    /**
     * Sets a value of EDM version attribute of the Model.
     *
     * @param Version $version the version
     */
    public function SetEdmVersion(Version $version);

    /**
     * Gets the value for the EDMX version of the model.
     *
     * @return Version the version
     */
    public function GetEdmxVersion(): ?Version;

    /**
     *  Sets a value of EDMX version attribute of the model.
     *
     * @param Version $version the version
     */
    public function SetEdmxVersion(Version $version): void;

    /**
     * Sets a value for the DataServiceVersion attribute in an EDMX artifact.
     *
     * @param Version $version the value of the attribute
     */
    public function SetDataServiceVersion(Version $version): void;

    /**
     * Gets the value for the DataServiceVersion attribute used during EDMX serialization.
     *
     * @return Version value of the attribute
     */
    public function GetDataServiceVersion(): ?Version;

    /**
     * Sets a value for the MaxDataServiceVersion attribute in an EDMX artifact.
     *
     * @param Version $version the value of the attribute
     */
    public function SetMaxDataServiceVersion(Version $version): void;

    /**
     * Gets the value for the MaxDataServiceVersion attribute used during EDMX serialization.
     *
     * @return Version value of the attribute
     */
    public function GetMaxDataServiceVersion(): ?Version;

    /**
     * Sets an annotation on the IEdmModel to notify the serializer of preferred prefix mappings for xml namespaces.
     *
     * @param array $mappings xmlNamespaceManage containing mappings between namespace prefixes and xml namespaces
     */
    public function SetNamespacePrefixMappings(array $mappings): void;

    /**
     * Gets the preferred prefix mappings for xml namespaces from an IEdmModel.
     *
     * @return array namespace prefixes that exist on the model
     */
    public function GetNamespacePrefixMappings(): array;

    /**
     * Sets the name used for the association end serialized for a navigation property.
     *
     * @param INavigationProperty $property the navigation property
     * @param string $association the association end name
     */
    public function SetAssociationEndName(INavigationProperty $property, string $association): void;

    /**
     * Gets the name used for the association end serialized for a navigation property.
     *
     * @param INavigationProperty $property the navigation property
     * @return string              the association end name
     */
    public function GetAssociationEndName(INavigationProperty $property): string;

    /**
     * Gets the fully-qualified name used for the association serialized for a navigation property.
     *
     * @param INavigationProperty $property the navigation property
     * @return string              the fully-qualified association name
     */
    public function GetAssociationFullName(INavigationProperty $property): string;

    public function FindType(string $qualifiedName): ?ISchemaType;

    /**
     * Sets the name used for the association serialized for a navigation property.
     *
     * @param INavigationProperty $property the navigation property
     * @param string $associationName the association name
     */
    public function SetAssociationName(INavigationProperty $property, string $associationName): void;

    /**
     * Gets the name used for the association serialized for a navigation property.
     *
     * @param INavigationProperty $property the navigation property
     * @return string              the association name
     */
    public function GetAssociationName(INavigationProperty $property): string;

    /**
     * Sets the namespace used for the association serialized for a navigation property.
     *
     * @param INavigationProperty $property the navigation property
     * @param string $associationNamespace the association namespace
     */
    public function SetAssociationNamespace(INavigationProperty $property, string $associationNamespace): void;

    /**
     * Gets the namespace used for the association serialized for a navigation property.
     *
     * @param INavigationProperty $property the navigation property
     * @return string              the association namespace
     */
    public function GetAssociationNamespace(INavigationProperty $property): string;

    /**
     * Sets the name used for the association set serialized for a navigation property of an entity set.
     *
     * @param IEntitySet $entitySet The entity set
     * @param INavigationProperty $property the navigation property
     * @param string $associationSet the association set name
     */
    public function SetAssociationSetName(IEntitySet $entitySet, INavigationProperty $property, string $associationSet): void;

    /**
     * Gets the name used for the association set serialized for a navigation property of an entity set.
     *
     * @param IEntitySet $entitySet the entity set
     * @param INavigationProperty $property the navigation property
     * @return string              the association set name
     */
    public function GetAssociationSetName(IEntitySet $entitySet, INavigationProperty $property): string;

    /**
     * Gets the annotations associated with the association serialized for a navigation target of an entity set.
     *
     * @param IEntitySet $entitySet the entity set
     * @param INavigationProperty $property the navigation property
     * @param iterable $annotations the association set annotations
     * @param iterable $end1Annotations the annotations for association set end 1
     * @param iterable $end2Annotations the annotations for association set end 2
     */
    public function GetAssociationSetAnnotations(IEntitySet $entitySet, INavigationProperty $property, iterable &$annotations = [], iterable &$end1Annotations = [], iterable &$end2Annotations = []): void;

    /**
     * Gets the annotations associated with the association serialized for a navigation property.
     *
     * @param INavigationProperty $property the navigation property
     * @param iterable $annotations the association annotations
     * @param iterable $end1Annotations the annotations for association end 1
     * @param iterable $end2Annotations the annotations for association end 2
     * @param iterable $constraintAnnotations the annotations for the referential constraint
     */
    public function GetAssociationAnnotations(INavigationProperty $property, iterable &$annotations = [], iterable &$end1Annotations = [], iterable &$end2Annotations = [], iterable &$constraintAnnotations = []);

    /**
     * Finds a list of types that derive from the supplied type directly or indirectly, and across models.
     *
     * @param IStructuredType $baseType the base type that derived types are being searched for
     * @return array           a list of types that derive from the type
     */
    public function FindAllDerivedTypes(IStructuredType $baseType): array;
}