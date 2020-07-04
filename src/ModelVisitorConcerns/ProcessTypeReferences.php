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
    protected function ProcessComplexTypeReference(IComplexTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessStructuredTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessEntityTypeReference(IEntityTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessStructuredTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessEntityReferenceTypeReference(IEntityReferenceTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessTypeReference($reference);
        $this->ProcessEntityReferenceType($reference->EntityReferenceDefinition());
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessRowTypeReference(IRowTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessStructuredTypeReference($reference);
        $this->ProcessRowType($reference->RowDefinition());
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessCollectionTypeReference(ICollectionTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessTypeReference($reference);
        $this->ProcessCollectionType($reference->CollectionDefinition());
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessEnumTypeReference(IEnumTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessBinaryTypeReference(IBinaryTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessDecimalTypeReference(IDecimalTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessSpatialTypeReference(ISpatialTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessStringTypeReference(IStringTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessTemporalTypeReference(ITemporalTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessPrimitiveTypeReference(IPrimitiveTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessStructuredTypeReference(IStructuredTypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessTypeReference(ITypeReference $reference): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($reference, __METHOD__);
        $this->ProcessElement($reference);
        $this->endElement($reference, __METHOD__);
    }
}
