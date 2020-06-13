<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Enums\TermKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Trait VisitAnnotations.
 * @package AlgoWeb\ODataMetadata\ModelVisitorConcerns
 * @mixin EdmModelVisitor
 */
trait VisitAnnotations
{

    /**
     * @param IDirectValueAnnotation[] $annotations
     */
    public function visitAnnotations(iterable $annotations): void
    {
        self::visitCollection($annotations, [$this,'visitAnnotation']);
    }

    /**
     * @param IVocabularyAnnotation[] $annotations
     */
    public function visitVocabularyAnnotations(array $annotations): void
    {
        self::visitCollection($annotations, [$this, 'visitVocabularyAnnotation']);
    }
    public function visitAnnotation(IDirectValueAnnotation $annotation): void
    {
        $this->processImmediateValueAnnotation($annotation);
    }

    public function visitVocabularyAnnotation(IVocabularyAnnotation $annotation): void
    {
        if ($annotation->getTerm() != null) {
            switch ($annotation->getTerm()->getTermKind()) {
                case TermKind::Type():
                    assert($annotation instanceof ITypeAnnotation);
                    $this->processTypeAnnotation($annotation);
                    break;
                case TermKind::Value():
                    assert($annotation instanceof IValueAnnotation);
                    $this->processValueAnnotation($annotation);
                    break;
                case TermKind::None():
                    $this->processVocabularyAnnotation($annotation);
                    break;
                default:
                    throw new InvalidOperationException(StringConst::UnknownEnumVal_TermKind($annotation->getTerm()->getTermKind()->getKey()));
            }
        } else {
            $this->processVocabularyAnnotation($annotation);
        }
    }

    /**
     * @param IPropertyValueBinding[] $bindings
     */
    public function visitPropertyValueBindings(array $bindings): void
    {
        self::visitCollection($bindings, [$this, 'processPropertyValueBinding']);
    }
    abstract public function processImmediateValueAnnotation(IDirectValueAnnotation $annotation): void;
    abstract public function processTypeAnnotation(ITypeAnnotation $annotation): void;
    abstract public function processValueAnnotation(IValueAnnotation $annotation): void;
    abstract public function processVocabularyAnnotation(IVocabularyAnnotation $annotation): void;
    abstract public function processPropertyValueBinding(IPropertyValueBinding $annotation): void;
}
