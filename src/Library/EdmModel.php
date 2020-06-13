<?php


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\Library\Annotations\EdmDirectValueAnnotationsManager;
use AlgoWeb\ODataMetadata\StringConst;
use SplObjectStorage;

/**
 * Represents an EDM model.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmModel extends EdmModelBase
{
    /**
     * @var ISchemaElement[]
     */
    private $elements = [];
    /**
     * @var SplObjectStorage|array<IVocabularyAnnotatable, IVocabularyAnnotation[]>
     */
    private $vocabularyAnnotationsDictionary;
    /**
     * @var SplObjectStorage|array<IStructuredType, IStructuredType[]>
     */
    private $derivedTypeMappings ;
    public function __construct(array $referencedModels = [], EdmDirectValueAnnotationsManager $annotationsManager = null)
    {
        $annotationsManager = $annotationsManager ?? new EdmDirectValueAnnotationsManager();
        parent::__construct($referencedModels, $annotationsManager);
        $this->vocabularyAnnotationsDictionary = new SplObjectStorage();
    }

    /**
     * @return ISchemaElement[] Gets the collection of schema elements that are contained in this model.
     */
    public function getSchemaElements(): array
    {
        return $this->elements;
    }
    /**
     * @return IVocabularyAnnotation[] Gets the collection of vocabulary annotations that are contained in this model.
     */
    public function getVocabularyAnnotations(): array
    {
        $values = [];
        foreach($this->vocabularyAnnotationsDictionary as $annotation){
            $values[] = $annotation;
        }
        return $values;
    }
    /**
     * Adds a model reference to this model.
     *
     * @param IModel $model The model to reference.
     */
    public function AddReferencedModel(IModel $model): void
    {
        parent::AddReferencedModel($model);
    }
    /**
     * Finds a list of types that derive directly from the supplied type.
     *
     * @param IStructuredType $baseType The base type that derived types are being searched for.
     * @return IStructuredType[] A list of types from this model that derive directly from the given type.
     */
    public function findDirectlyDerivedTypes(IStructuredType $baseType): array
    {
        if ($this->derivedTypeMappings->offsetExists($baseType)) {
            return $this->derivedTypeMappings->offsetGet($baseType);
        }
        return [];
    }

    /**
     * Adds a schema element to this model.
     *
     * @param ISchemaElement $element Element to be added.
     */
    public function AddElement(ISchemaElement $element): void
    {
        $this->elements[] = $element;
        if ($element instanceof IStructuredType && $element->getBaseType() !== null) {
            if (!$this->derivedTypeMappings->offsetExists($element->getBaseType())) {
                $this->derivedTypeMappings->offsetSet($element, []);
            }
            $derivedTypes = $this->derivedTypeMappings->offsetGet($element);
            $this->derivedTypeMappings->offsetSet($element, $derivedTypes);
        }
        $this->RegisterElement($element);
    }

    /**
     *  Adds a collection of schema elements to this model.
     *
     * @param ISchemaElement[] $newElements Elements to be added.
     */
    public function AddElements(array $newElements): void
    {
        foreach ($newElements as $element)
        {
            $this->AddElement($element);
        }
    }

    /**
     * Adds a vocabulary annotation to this model.
     *
     * @param IVocabularyAnnotation $annotation The annotation to be added.
     */
    public function AddVocabularyAnnotation(IVocabularyAnnotation $annotation)
    {
        if ($annotation->getTarget() == null)
        {
            throw new InvalidOperationException(StringConst::Constructable_VocabularyAnnotationMustHaveTarget());
        }

        $elementAnnotations = [];
        if($this->vocabularyAnnotationsDictionary->offsetExists($annotation->getTarget())){
            $elementAnnotations = $this->vocabularyAnnotationsDictionary->offsetGet($annotation->getTarget());
        }
        $elementAnnotations[] = $annotation;

        $this->vocabularyAnnotationsDictionary->offsetSet($annotation->getTarget(), $elementAnnotations);
    }
}