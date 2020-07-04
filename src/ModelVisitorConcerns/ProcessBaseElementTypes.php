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
    protected function ProcessElement(IEdmElement $element): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($element, __METHOD__);
        $this->VisitAnnotations($this->model->getDirectValueAnnotationsManager()->getDirectValueAnnotations($element));
        $this->endElement($element, __METHOD__);
    }

    protected function ProcessNamedElement(INamedElement $element): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($element, __METHOD__);
        $this->ProcessElement($element);
        $this->endElement($element, __METHOD__);
    }

    protected function ProcessSchemaElement(ISchemaElement $element): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($element, __METHOD__);
        $this->ProcessVocabularyAnnotatable($element);
        $this->ProcessNamedElement($element);
        $this->endElement($element, __METHOD__);
    }

    protected function ProcessVocabularyAnnotatable(IVocabularyAnnotatable $annotatable): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($annotatable, __METHOD__);
        $this->endElement($annotatable, __METHOD__);
    }
}
