<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Visitor;

use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IComplexTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IRowTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

interface ITypeReferencesVisitor
{
    public function startComplexTypeReference(IComplexTypeReference $reference): void;
    public function endComplexTypeReference(IComplexTypeReference $reference): void;
    public function startEntityTypeReference(IEntityTypeReference $reference): void;
    public function endEntityTypeReference(IEntityTypeReference $reference): void;
    public function startEntityReferenceTypeReference(IEntityReferenceTypeReference $reference): void;
    public function endEntityReferenceTypeReference(IEntityReferenceTypeReference $reference): void;
    public function startRowTypeReference(IRowTypeReference $reference): void;
    public function endRowTypeReference(IRowTypeReference $reference): void;
    public function startCollectionTypeReference(ICollectionTypeReference $reference): void;
    public function endCollectionTypeReference(ICollectionTypeReference $reference): void;
    public function startEnumTypeReference(IEnumTypeReference $reference): void;
    public function endEnumTypeReference(IEnumTypeReference $reference): void;
    public function startBinaryTypeReference(IBinaryTypeReference $reference): void;
    public function endBinaryTypeReference(IBinaryTypeReference $reference): void;
    public function startDecimalTypeReference(IDecimalTypeReference $reference): void;
    public function endDecimalTypeReference(IDecimalTypeReference $reference): void;
    public function startSpatialTypeReference(ISpatialTypeReference $reference): void;
    public function endSpatialTypeReference(ISpatialTypeReference $reference): void;
    public function startStringTypeReference(IStringTypeReference $reference): void;
    public function endStringTypeReference(IStringTypeReference $reference): void;
    public function startTemporalTypeReference(ITemporalTypeReference $reference): void;
    public function endTemporalTypeReference(ITemporalTypeReference $reference): void;
    public function startPrimitiveTypeReference(IPrimitiveTypeReference $reference): void;
    public function endPrimitiveTypeReference(IPrimitiveTypeReference $reference): void;
    public function startStructuredTypeReference(IStructuredTypeReference $reference): void;
    public function endStructuredTypeReference(IStructuredTypeReference $reference): void;
    public function startTypeReference(ITypeReference $element): void;
    public function endTypeReference(ITypeReference $element): void;
}
