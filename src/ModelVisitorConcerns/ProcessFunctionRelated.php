<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

trait ProcessFunctionRelated
{
    protected function ProcessFunction(IFunction $function): void
    {
        $this->startElement($function, __METHOD__);
        $this->ProcessSchemaElement($function);
        $this->ProcessFunctionBase($function);
        $this->endElement($function, __METHOD__);
    }

    protected function ProcessFunctionImport(IFunctionImport $functionImport): void
    {
        $this->startElement($functionImport, __METHOD__);
        $this->ProcessEntityContainerElement($functionImport);
        $this->ProcessFunctionBase($functionImport);
        $this->endElement($functionImport, __METHOD__);
    }

    protected function ProcessFunctionBase(IFunctionBase $functionBase): void
    {
        $this->startElement($functionBase, __METHOD__);
        if ($functionBase->getReturnType() != null) {
            $this->VisitTypeReference($functionBase->getReturnType());
        }

        // Do not visit vocabularyAnnotatable because functions and function imports are always going to be either a schema element or a container element and will be visited through those paths.
        $this->VisitFunctionParameters($functionBase->getParameters());
        $this->endElement($functionBase, __METHOD__);
    }

    protected function ProcessFunctionParameter(IFunctionParameter $parameter): void
    {
        $this->startElement($parameter, __METHOD__);
        $this->ProcessVocabularyAnnotatable($parameter);
        $this->ProcessNamedElement($parameter);
        $this->VisitTypeReference($parameter->getType());
        $this->endElement($parameter, __METHOD__);
    }

    abstract public function ProcessSchemaElement(ISchemaElement $function): void;

    abstract public function ProcessVocabularyAnnotatable(IVocabularyAnnotatable $parameter): void;

    abstract public function ProcessNamedElement(INamedElement $parameter): void;

    abstract public function VisitTypeReference(ITypeReference $getType): void;

    abstract public function VisitFunctionParameters(?array $getParameters): void;

    abstract public function ProcessEntityContainerElement(IEntityContainerElement $functionImport): void;
}
