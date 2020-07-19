<?php


namespace AlgoWeb\ODataMetadata\Library\Annotations;

use AlgoWeb\ODataMetadata\Helpers\TypeAnnotationHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

/**
 * Represents an EDM type annotation.
 * @package AlgoWeb\ODataMetadata\Library\Annotations
 */
class EdmTypeAnnotation extends EdmVocabularyAnnotation implements ITypeAnnotation
{
    use TypeAnnotationHelpers;
    /**
     * @var IPropertyValueBinding[]
     */
    private $propertyValueBindings;

    /**
     * Initializes a new instance of the EdmTypeAnnotation class.
     * @param IVocabularyAnnotatable $target Element the annotation applies to.
     * @param ITerm $term Term bound by the annotation.
     * @param string|null $qualifier Qualifier used to discriminate between multiple bindings of the same property or type.
     * @param IPropertyValueBinding ...$propertyValueBindings Value annotations for the properties of the type.
     */
    public function __construct(IVocabularyAnnotatable $target, ITerm $term, string $qualifier = null, IPropertyValueBinding ...$propertyValueBindings)
    {
        parent::__construct($target, $term, $qualifier);
        $this->propertyValueBindings = $propertyValueBindings;

    }

    /**
     * @inheritDoc
     */
    public function getPropertyValueBindings(): array
    {
        return $this->propertyValueBindings;
    }

}