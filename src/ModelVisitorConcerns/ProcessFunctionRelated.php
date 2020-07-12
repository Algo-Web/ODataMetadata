<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
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
        /** @var EdmModelVisitor $this */
        $this->startElement($function, __METHOD__);
        $this->ProcessSchemaElement($function);
        $this->ProcessFunctionBase($function);
        $this->endElement($function, __METHOD__);
    }

    protected function ProcessFunctionImport(IFunctionImport $functionImport): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($functionImport, __METHOD__);
        $this->ProcessEntityContainerElement($functionImport);
        $this->ProcessFunctionBase($functionImport);
        $this->endElement($functionImport, __METHOD__);
    }

    protected function ProcessFunctionBase(IFunctionBase $functionBase): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($functionBase, __METHOD__);
        if (null !== $functionBase->getReturnType()) {
            $this->VisitTypeReference($functionBase->getReturnType());
        }

        // Do not visit vocabularyAnnotatable because functions and function imports are always going to be either a
        // schema element or a container element and will be visited through those paths.
        $this->VisitFunctionParameters($functionBase->getParameters());
        $this->endElement($functionBase, __METHOD__);
    }

    protected function ProcessFunctionParameter(IFunctionParameter $parameter): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($parameter, __METHOD__);
        $this->ProcessVocabularyAnnotatable($parameter);
        $this->ProcessNamedElement($parameter);
        $this->VisitTypeReference($parameter->getType());
        $this->endElement($parameter, __METHOD__);
    }
}
