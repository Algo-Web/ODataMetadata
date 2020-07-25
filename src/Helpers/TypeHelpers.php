<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\ITypeHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\IType;

/**
 * Trait TypeHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait TypeHelpers
{
    public function isOrInheritsFrom(IType $otherType): bool
    {
        $thisType = $this;
        if ($thisType == null || $otherType == null) {
            return false;
        }

        if ($thisType === $otherType) {
            return true;
        }

        $thisKind = $thisType->getTypeKind();
        if (!$thisKind->equals($otherType->getTypeKind()) ||
                !(
                    $thisKind->isEntity() ||
                    $thisKind->isComplex() ||
                    $thisKind->isRow()
                )
            ) {
            return false;
        }

        assert($thisType instanceof IStructuredType, 'by this point types should be structures');
        assert($otherType instanceof IStructuredType, 'by this point types should be structures');
        return $thisType->inheritsFrom($otherType);
    }

    /**
     * @return TypeKind gets the kind of this type
     */
    abstract public function getTypeKind(): TypeKind;
}
