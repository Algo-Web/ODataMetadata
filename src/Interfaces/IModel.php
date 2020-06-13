<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\ModelHelpers;

/**
 * Interface IEdmModel
 *
 * Semantic representation of an EDM model.
 *
 * This interface, and all interfaces reachable from it, preserve certain invariants:
 * -- The backing implementation of an element can be loaded or created on demand.
 * -- No direct element mutation occurs through the interfaces.
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 * @mixin ModelHelpers
 */
interface IModel extends IEdmElement
{
    /**
     * @return ISchemaElement[] Gets the collection of schema elements that are contained in this model.
     */
    public function getSchemaElements(): array;

    /**
     * @return Annotations\IVocabularyAnnotation[] Gets the collection of vocabulary annotations that are contained in this model.
     */
    public function getVocabularyAnnotations(): array;

    /**
     * @return IModel[] Gets the collection of models referred to by this model.
     */
    public function getReferencedModels(): array;

    /**
     * @return Annotations\IDirectValueAnnotationsManager Gets the model's annotations manager.
     */
    public function getDirectValueAnnotationsManager(): Annotations\IDirectValueAnnotationsManager;

    /**
     * Searches for an entity container with the given name in this model and returns null if no such entity container
     * exists.
     *
     * @param string $qualifiedName The name of the entity container being found.
     * @return ISchemaType|null The requested entity container, or null if no such entity container exists
     */
    public function findDeclaredType(string $qualifiedName): ?ISchemaType;

    /**
     * Searches for a type with the given name in this model and returns null if no such type exists.
     *
     * @param string $name The qualified name of the type being found.
     * @return IEntityContainer|null The requested type, or null if no such type exists.
     */
    public function findDeclaredEntityContainer(string $name): ?IEntityContainer;

    /**
     * Searches for functions with the given name in this model and returns an empty enumerable if no such function
     * exists.
     *
     * @param string $qualifiedName The qualified name of the function being found.
     * @return IFunction[] A set of functions sharing the specified qualified name, or an empty enumerable if no
     *                        such function exists.
     */
    public function findDeclaredFunctions(string $qualifiedName): array;

    /**
     * Searches for a value term with the given name in this model and returns null if no such value term exists.
     *
     * @param string $qualifiedName The qualified name of the value term being found.
     * @return IValueTerm|null The requested value term, or null if no such value term exists.
     */
    public function findDeclaredValueTerm(string $qualifiedName): ?IValueTerm;

    /**
     *  Searches for vocabulary annotations specified by this model.
     *
     * @param IVocabularyAnnotatable $element The annotated element.
     * @return Annotations\IVocabularyAnnotation[] The vocabulary annotations for the element.
     */
    public function findDeclaredVocabularyAnnotations(IVocabularyAnnotatable $element): array;

    /**
     * Finds a list of types that derive directly from the supplied type.
     *
     * @param IStructuredType $baseType The base type that derived types are being searched for.
     * @return IStructuredType[] A list of types from this model that derive directly from the given type.
     */
    public function findDirectlyDerivedTypes(IStructuredType $baseType): array;
}