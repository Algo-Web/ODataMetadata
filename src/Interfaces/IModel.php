<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\Interfaces\IModelHelpers;
use AlgoWeb\ODataMetadata\Helpers\ModelHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;

/**
 * Interface IEdmModel.
 *
 * Semantic representation of an EDM model.
 *
 * This interface, and all interfaces reachable from it, preserve certain invariants:
 * -- The backing implementation of an element can be loaded or created on demand.
 * -- No direct element mutation occurs through the interfaces.
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IModel extends IEdmElement, IModelHelpers
{
    /**
     * @return ISchemaElement[] gets the collection of schema elements that are contained in this model
     */
    public function getSchemaElements(): array;

    /**
     * @return Annotations\IVocabularyAnnotation[] gets the collection of vocabulary annotations that are contained in this model
     */
    public function getVocabularyAnnotations(): array;

    /**
     * @return IModel[] gets the collection of models referred to by this model
     */
    public function getReferencedModels(): array;

    /**
     * @return Annotations\IDirectValueAnnotationsManager gets the model's annotations manager
     */
    public function getDirectValueAnnotationsManager(): Annotations\IDirectValueAnnotationsManager;

    /**
     * Searches for an entity container with the given name in this model and returns null if no such entity container
     * exists.
     *
     * @param  string           $qualifiedName the name of the entity container being found
     * @return ISchemaType|null The requested entity container, or null if no such entity container exists
     */
    public function findDeclaredType(string $qualifiedName): ?ISchemaType;

    /**
     * Searches for a type with the given name in this model and returns null if no such type exists.
     *
     * @param  string                $name the qualified name of the type being found
     * @return IEntityContainer|null the requested type, or null if no such type exists
     */
    public function findDeclaredEntityContainer(string $name): ?IEntityContainer;

    /**
     * Searches for functions with the given name in this model and returns an empty enumerable if no such function
     * exists.
     *
     * @param  string      $qualifiedName the qualified name of the function being found
     * @return IFunction[] a set of functions sharing the specified qualified name, or an empty enumerable if no
     *                                   such function exists
     */
    public function findDeclaredFunctions(string $qualifiedName): array;

    /**
     * Searches for a value term with the given name in this model and returns null if no such value term exists.
     *
     * @param  string          $qualifiedName the qualified name of the value term being found
     * @return IValueTerm|null the requested value term, or null if no such value term exists
     */
    public function findDeclaredValueTerm(string $qualifiedName): ?IValueTerm;

    /**
     *  Searches for vocabulary annotations specified by this model.
     *
     * @param  IVocabularyAnnotatable              $element the annotated element
     * @return Annotations\IVocabularyAnnotation[] the vocabulary annotations for the element
     */
    public function findDeclaredVocabularyAnnotations(IVocabularyAnnotatable $element): array;

    /**
     * Gets an annotatable element's vocabulary annotations that bind a particular term.
     *
     * @param  IVocabularyAnnotatable           $element   element to check for annotations
     * @param  ITerm|string                     $term      Term to search for. OR Name of the term to search for.
     * @param  string|null                      $qualifier qualifier to apply
     * @param  string|null                      $type      type of the annotation being returned
     * @return iterable|IVocabularyAnnotation[] annotations attached to the element by this model or by models
     *                                                    referenced by this model that bind the term with the given qualifier
     */
    public function FindVocabularyAnnotations(
        IVocabularyAnnotatable $element,
        $term = null,
        string $qualifier = null,
        string $type = null
    ): iterable;

    /**
     * Gets an annotatable element's vocabulary annotations defined in a specific model and models referenced by
     * that model.
     * @param  IVocabularyAnnotatable  $element element to check for annotations
     * @return IVocabularyAnnotation[] annotations attached to the element (or, if the element is a type, to its base
     *                                         types) by this model or by models referenced by this model
     */
    public function FindVocabularyAnnotationsIncludingInheritedAnnotations(IVocabularyAnnotatable $element): array;


    /**
     * Finds a list of types that derive directly from the supplied type.
     *
     * @param  IStructuredType   $baseType the base type that derived types are being searched for
     * @return IStructuredType[] a list of types from this model that derive directly from the given type
     */
    public function findDirectlyDerivedTypes(IStructuredType $baseType): array;
}
