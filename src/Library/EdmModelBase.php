<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Helpers\ModelHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Annotations;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\Internal\RegistrationHelper;
use AlgoWeb\ODataMetadata\Library\Annotations\EdmDirectValueAnnotationsManager;
use AlgoWeb\ODataMetadata\Library\Core\EdmCoreModel;

/**
 *  Represents an EDM model.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
abstract class EdmModelBase extends EdmElement implements IModel
{
    use ModelHelpers;
    /**
     * @var EdmDirectValueAnnotationsManager
     */
    private $annotationsManager;
    /**
     * @var array<string, IEntityContainer>
     */
    private $containersDictionary = [];
    /**
     * @var array<string, ISchemaType>
     */
    private $schemaTypeDictionary = [];
    /**
     * @var array<string, IValueTerm>
     */
    private $valueTermDictionary = [];
    /**
     * @var array<string, object>
     */
    private $functionDictionary = [];
    /**
     * @var IModel[]
     */
    private $referencedModels;

    /**
     * EdmModelBase constructor.
     * @param IModel[]                         $referencedModels
     * @param EdmDirectValueAnnotationsManager $annotationsManager
     */
    public function __construct(array $referencedModels, EdmDirectValueAnnotationsManager $annotationsManager)
    {
        $this->referencedModels   = $referencedModels;
        $this->referencedModels[] = EdmCoreModel::getInstance();
        $this->annotationsManager = $annotationsManager;
    }

    /**
     * @return ISchemaElement[] gets the collection of schema elements that are contained in this model
     */
    abstract public function getSchemaElements(): array;

    /**
     * @return Annotations\IVocabularyAnnotation[] gets the collection of vocabulary annotations that are contained in this model
     */
    public function getVocabularyAnnotations(): array
    {
        return [];
    }

    /**
     * @return IModel[] gets the collection of models referred to by this model
     */
    public function getReferencedModels(): array
    {
        return $this->referencedModels;
    }

    /**
     * @return Annotations\IDirectValueAnnotationsManager gets the model's annotations manager
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
        return array_key_exists($qualifiedName, $this->schemaTypeDictionary) ? $this->schemaTypeDictionary[$qualifiedName] : null;
    }

    /**
     * Searches for a type with the given name in this model and returns null if no such type exists.
     *
     * @param  string                $name the qualified name of the type being found
     * @return IEntityContainer|null the requested type, or null if no such type exists
     */
    public function findDeclaredEntityContainer(string $name): ?IEntityContainer
    {
        return array_key_exists($name, $this->containersDictionary) ? $this->containersDictionary[$name] : null;
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
        if (array_key_exists($qualifiedName, $this->functionDictionary)) {
            $element = $this->functionDictionary[$qualifiedName];
            if ($element instanceof  IFunction) {
                return [$element];
            }

            return $element ;
        }

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
        return array_key_exists($qualifiedName, $this->valueTermDictionary) ? $this->valueTermDictionary[$qualifiedName] : null;
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
    abstract public function findDirectlyDerivedTypes(IStructuredType $baseType): array;

    /**
     * Adds a schema element to this model.
     *
     * @param ISchemaElement $element the element to register
     */
    protected function RegisterElement(ISchemaElement $element): void
    {
        RegistrationHelper::RegisterSchemaElement($element, $this->schemaTypeDictionary, $this->valueTermDictionary, $this->functionDictionary, $this->containersDictionary);
    }

    /**
     * Adds a model reference to this model.
     *
     * @param IModel $model the model to reference
     */
    protected function AddReferencedModel(IModel $model): void
    {
        $this->referencedModels[] = $model;
    }
}
