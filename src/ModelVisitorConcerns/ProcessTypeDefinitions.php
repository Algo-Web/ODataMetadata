<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

trait ProcessTypeDefinitions
{
    protected function processComplexType(IComplexType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->processSchemaElement($definition);
        $this->processStructuredType($definition);
        $this->processSchemaType($definition);
        $this->endElement($definition, __METHOD__);
    }

    protected function processEntityType(IEntityType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->processSchemaElement($definition);
        $this->processTerm($definition);
        $this->processStructuredType($definition);
        $this->processSchemaType($definition);
        $this->endElement($definition, __METHOD__);
    }

    protected function processRowType(IRowType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->processElement($definition);
        $this->processStructuredType($definition);
        $this->endElement($definition, __METHOD__);
    }

    protected function processCollectionType(ICollectionType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->processElement($definition);
        $this->processType($definition);
        $this->visitTypeReference($definition->getElementType());
        $this->endElement($definition, __METHOD__);
    }

    protected function processEnumType(IEnumType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->processSchemaElement($definition);
        $this->processType($definition);
        $this->processSchemaType($definition);
        $this->visitEnumMembers($definition->getMembers());
        $this->endElement($definition, __METHOD__);
    }

    protected function processEntityReferenceType(IEntityReferenceType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->processElement($definition);
        $this->processType($definition);
        $this->endElement($definition, __METHOD__);
    }

    protected function processStructuredType(IStructuredType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->processType($definition);
        $this->visitProperties($definition->getDeclaredProperties());
        $this->endElement($definition, __METHOD__);
    }

    protected function processSchemaType(ISchemaType $type): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($type, __METHOD__);
        // Do not visit type or schema element, because all types will do that on thier own.
        $this->endElement($type, __METHOD__);
    }

    protected function processType(IType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->endElement($definition, __METHOD__);
    }
}
