<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;

trait ProcessAnnotations
{
    protected function ProcessVocabularyAnnotation(IVocabularyAnnotation $annotation): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($annotation, __METHOD__);
        $this->ProcessElement($annotation);
        $this->endElement($annotation, __METHOD__);
    }

    protected function ProcessImmediateValueAnnotation(IDirectValueAnnotation $annotation): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($annotation, __METHOD__);
        $this->ProcessNamedElement($annotation);
        $this->endElement($annotation, __METHOD__);
    }

    protected function ProcessValueAnnotation(IValueAnnotation $annotation): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($annotation, __METHOD__);
        $this->ProcessVocabularyAnnotation($annotation);
        $this->VisitExpression($annotation->getValue());
        $this->endElement($annotation, __METHOD__);
    }

    protected function ProcessTypeAnnotation(ITypeAnnotation $annotation): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($annotation, __METHOD__);
        $this->ProcessVocabularyAnnotation($annotation);
        $this->VisitPropertyValueBindings($annotation->getPropertyValueBindings());
        $this->endElement($annotation, __METHOD__);
    }

    protected function ProcessPropertyValueBinding(IPropertyValueBinding $binding): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($binding, __METHOD__);
        $this->VisitExpression($binding->getValue());
        $this->endElement($binding, __METHOD__);
    }
}
