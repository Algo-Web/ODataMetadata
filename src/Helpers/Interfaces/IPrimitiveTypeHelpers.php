<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;

/**
 * Trait PrimitiveTypeHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IPrimitiveTypeHelpers
{
    public function GetPrimitiveTypeReference(bool $isNullable): IPrimitiveTypeReference;
}