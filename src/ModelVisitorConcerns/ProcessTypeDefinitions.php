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
    protected function ProcessComplexType(IComplexType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->ProcessSchemaElement($definition);
        $this->ProcessStructuredType($definition);
        $this->ProcessSchemaType($definition);
        $this->endElement($definition, __METHOD__);
    }

    protected function ProcessEntityType(IEntityType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->ProcessSchemaElement($definition);
        $this->ProcessTerm($definition);
        $this->ProcessStructuredType($definition);
        $this->ProcessSchemaType($definition);
        $this->endElement($definition, __METHOD__);
    }

    protected function ProcessRowType(IRowType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->ProcessElement($definition);
        $this->ProcessStructuredType($definition);
        $this->endElement($definition, __METHOD__);
    }

    protected function ProcessCollectionType(ICollectionType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->ProcessElement($definition);
        $this->ProcessType($definition);
        $this->VisitTypeReference($definition->getElementType());
        $this->endElement($definition, __METHOD__);
    }

    protected function ProcessEnumType(IEnumType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->ProcessSchemaElement($definition);
        $this->ProcessType($definition);
        $this->ProcessSchemaType($definition);
        $this->VisitEnumMembers($definition->getMembers());
        $this->endElement($definition, __METHOD__);
    }

    protected function ProcessEntityReferenceType(IEntityReferenceType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->ProcessElement($definition);
        $this->ProcessType($definition);
        $this->endElement($definition, __METHOD__);
    }

    protected function ProcessStructuredType(IStructuredType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->ProcessType($definition);
        $this->VisitProperties($definition->getDeclaredProperties());
        $this->endElement($definition, __METHOD__);
    }

    protected function ProcessSchemaType(ISchemaType $type): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($type, __METHOD__);
        // Do not visit type or schema element, because all types will do that on thier own.
        $this->endElement($type, __METHOD__);
    }

    protected function ProcessType(IType $definition): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($definition, __METHOD__);
        $this->endElement($definition, __METHOD__);
    }
}