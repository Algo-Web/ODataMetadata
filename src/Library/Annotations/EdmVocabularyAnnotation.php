<?php


namespace AlgoWeb\ODataMetadata\Library\Annotations;

use AlgoWeb\ODataMetadata\Helpers\VocabularyAnnotationHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM annotation with an immediate value.
 * @package AlgoWeb\ODataMetadata\Library\Annotations
 */
abstract class EdmVocabularyAnnotation extends EdmElement implements IVocabularyAnnotation
{
    use VocabularyAnnotationHelpers;

    /**
     * @var IVocabularyAnnotatable
     */
    private $target;
    /**
     * @var ITerm
     */
        private $term;
    /**
     * @var string
     */
        private $qualifier;

    /**
     * Initializes a new instance of the EdmVocabularyAnnotation class.
     * @param IVocabularyAnnotatable $target Element the annotation applies to.
     * @param ITerm $term Term bound by the annotation.
     * @param string $qualifier Qualifier used to discriminate between multiple bindings of the same property or type.
     */
        protected function __construct(IVocabularyAnnotatable $target, ITerm $term, ?string $qualifier)
        {
            $this->target = $target;
            $this->term = $term;
            $this->qualifier = $qualifier;
        }

    /**
     * @inheritDoc
     */
    public function getQualifier(): ?string
    {
        return $this->qualifier;
    }

    /**
     * @inheritDoc
     */
    public function getTerm(): ITerm
    {
        return $this->term;
    }

    /**
     * @inheritDoc
     */
    public function getTarget(): IVocabularyAnnotatable
    {
        return $this->target;
    }

}