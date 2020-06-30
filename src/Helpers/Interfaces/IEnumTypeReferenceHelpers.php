<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Interfaces\IEnumType;

/**
 * Trait EnumTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IEnumTypeReferenceHelpers
{
    /**
     * Gets the definition of this enumeration reference.
     *
     * @return IEnumType the definition of this enumeration reference
     */
    public function EnumDefinition(): IEnumType;
}