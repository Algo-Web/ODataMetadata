<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\IType;

/**
 * Trait TypeHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface ITypeHelpers
{
    public function isOrInheritsFrom(IType $otherType): bool;
}
