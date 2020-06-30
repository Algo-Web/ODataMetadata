<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Interfaces\IComplexType;

/**
 * Trait ComplexTypeHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IComplexTypeHelpers
{
    /**
     * Gets the base type of this references definition.
     *
     * @return IComplexType the base type of this references definition
     */
    public function BaseComplexType(): IComplexType;
}