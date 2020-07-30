<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

/**
 * Class ProcessBaseElementTypes.
 * @package AlgoWeb\ODataMetadata\ModelVisitorConcerns
 */
trait ProcessBaseElementTypes
{
    protected function processElement(IEdmElement $element): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($element, __METHOD__);
        $this->visitAnnotations($this->model->getDirectValueAnnotationsManager()->getDirectValueAnnotations($element));
        $this->endElement($element, __METHOD__);
    }

    protected function processNamedElement(INamedElement $element): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($element, __METHOD__);
        $this->processElement($element);
        $this->endElement($element, __METHOD__);
    }

    protected function processSchemaElement(ISchemaElement $element): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($element, __METHOD__);
        $this->processVocabularyAnnotatable($element);
        $this->processNamedElement($element);
        $this->endElement($element, __METHOD__);
    }

    protected function processVocabularyAnnotatable(IVocabularyAnnotatable $annotatable): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($annotatable, __METHOD__);
        $this->endElement($annotatable, __METHOD__);
    }
}
