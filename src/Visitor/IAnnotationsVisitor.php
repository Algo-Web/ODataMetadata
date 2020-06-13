<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Visitor;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;

interface IAnnotationsVisitor
{
    public function startVocabularyAnnotation(IVocabularyAnnotation $annotation): void;
    public function endVocabularyAnnotation(IVocabularyAnnotation $annotation): void;
    public function startImmediateValueAnnotation(IDirectValueAnnotation $annotation): void;
    public function endImmediateValueAnnotation(IDirectValueAnnotation $annotation): void;
    public function startValueAnnotation(IValueAnnotation $annotation): void;
    public function endValueAnnotation(IValueAnnotation $annotation): void;
    public function startTypeAnnotation(ITypeAnnotation $annotation): void;
    public function endTypeAnnotation(ITypeAnnotation $annotation): void;
    public function startPropertyValueBinding(IPropertyValueBinding $binding): void;
    public function endPropertyValueBinding(IPropertyValueBinding $binding): void;
}
