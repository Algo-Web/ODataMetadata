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
    protected function processFunction(IFunction $function): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($function, __METHOD__);
        $this->processSchemaElement($function);
        $this->processFunctionBase($function);
        $this->endElement($function, __METHOD__);
    }

    protected function processFunctionImport(IFunctionImport $functionImport): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($functionImport, __METHOD__);
        $this->processEntityContainerElement($functionImport);
        $this->processFunctionBase($functionImport);
        $this->endElement($functionImport, __METHOD__);
    }

    protected function processFunctionBase(IFunctionBase $functionBase): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($functionBase, __METHOD__);
        if (null !== $functionBase->getReturnType()) {
            $this->visitTypeReference($functionBase->getReturnType());
        }

        // Do not visit vocabularyAnnotatable because functions and function imports are always going to be either a
        // schema element or a container element and will be visited through those paths.
        $this->visitFunctionParameters($functionBase->getParameters());
        $this->endElement($functionBase, __METHOD__);
    }

    protected function processFunctionParameter(IFunctionParameter $parameter): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($parameter, __METHOD__);
        $this->processVocabularyAnnotatable($parameter);
        $this->processNamedElement($parameter);
        $this->visitTypeReference($parameter->getType());
        $this->endElement($parameter, __METHOD__);
    }
}
