<?php


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;


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

/**
 */
trait ProcessTypeReferences
{

    protected function ProcessComplexTypeReference(IComplexTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessStructuredTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessEntityTypeReference(IEntityTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessStructuredTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessEntityReferenceTypeReference(IEntityReferenceTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessTypeReference($reference);
        $this->ProcessEntityReferenceType($reference->EntityReferenceDefinition());
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessRowTypeReference(IRowTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessStructuredTypeReference($reference);
        $this->ProcessRowType($reference->RowDefinition());
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessCollectionTypeReference(ICollectionTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessTypeReference($reference);
        $this->ProcessCollectionType($reference->CollectionDefinition());
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessEnumTypeReference(IEnumTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessBinaryTypeReference(IBinaryTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessDecimalTypeReference(IDecimalTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessSpatialTypeReference(ISpatialTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessStringTypeReference(IStringTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessTemporalTypeReference(ITemporalTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessPrimitiveTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessPrimitiveTypeReference(IPrimitiveTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessStructuredTypeReference(IStructuredTypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessTypeReference($reference);
        $this->endElement($reference, __METHOD__);
    }

    protected function ProcessTypeReference(ITypeReference $reference): void
    {
        $this->startElement($reference, __METHOD__);
        $this->ProcessElement($reference);
        $this->endElement($reference, __METHOD__);
    }

    abstract function ProcessEntityReferenceType(IEntityReferenceType $EntityReferenceDefinition): void;

    abstract function ProcessElement(IEdmElement $element): void;

    abstract function ProcessCollectionType(ICollectionType $CollectionDefinition): void;

    abstract function ProcessRowType(IRowType $RowDefinition): void;

}