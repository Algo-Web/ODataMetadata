<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Interfaces\IType;

/**
 * Trait TypeHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface ITypeHelpers
{
    public function IsOrInheritsFrom(IType $otherType): bool;
}