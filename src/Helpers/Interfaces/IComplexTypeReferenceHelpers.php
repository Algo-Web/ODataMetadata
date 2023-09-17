<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\IComplexType;

/**
 * Class ComplexTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IComplexTypeReferenceHelpers
{
    /**
     * Gets the definition of this reference typed as an IComplexTypeDefinition.
     *
     * @return IComplexType The definition of this reference
     */
    public function complexDefinition(): IComplexType;

    /**
     * Gets the base type of this reference.
     *
     * @return IComplexType the base type of this reference
     */
    public function baseComplexType(): IComplexType;
}
