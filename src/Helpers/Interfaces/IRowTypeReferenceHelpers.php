<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\IRowType;

/**
 * Trait RowTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IRowTypeReferenceHelpers
{
    /**
     * Gets the definition of this row type reference.
     *
     * @return IRowType the definition of this row type reference
     */
    public function RowDefinition(): IRowType;
}
