<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IComplexTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\IRowTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

trait ProcessTypeReferences
{
    protected function processComplexTypeReference(IComplexTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processStructuredTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function processEntityTypeReference(IEntityTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processStructuredTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function processEntityReferenceTypeReference(IEntityReferenceTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processTypeReference($reference);
        $this->ProcessEntityReferenceType($reference->EntityReferenceDefinition());
        $this->endElement($reference, __METHOD__);
    }

    protected function processRowTypeReference(IRowTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processStructuredTypeReference($reference);
        $this->ProcessRowType($reference->RowDefinition());
        $this->endElement($reference, __METHOD__);
    }

    protected function processCollectionTypeReference(ICollectionTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processTypeReference($reference);
        $this->ProcessCollectionType($reference->CollectionDefinition());
        $this->endElement($reference, __METHOD__);
    }

    protected function processEnumTypeReference(IEnumTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function processBinaryTypeReference(IBinaryTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function processDecimalTypeReference(IDecimalTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function processSpatialTypeReference(ISpatialTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function processStringTypeReference(IStringTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function processTemporalTypeReference(ITemporalTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function processPrimitiveTypeReference(IPrimitiveTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function processStructuredTypeReference(IStructuredTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function processTypeReference(ITypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->processElement($reference);
        $this->endElement($reference, __METHOD__);
    }
}
