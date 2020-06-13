<?php


namespace AlgoWeb\ODataMetadata\Visitor;


use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

interface IBaseElementTypesVisitor
{
    public function startElement(IEdmElement $element): void;
    public function endElement(IEdmElement $element): void;
    public function startNamedElement(INamedElement $element): void;
    public function endNamedElement(INamedElement $element): void;
    public function startSchemaElement(ISchemaElement $element): void;
    public function endSchemaElement(ISchemaElement $element): void;
    public function startVocabularyAnnotatable(IVocabularyAnnotatable $annotatable): void;
    public function endVocabularyAnnotatable(IVocabularyAnnotatable $annotatable): void;
}