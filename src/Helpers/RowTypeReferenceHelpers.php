<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\IRowTypeReference;

/**
 * Trait RowTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait RowTypeReferenceHelpers
{
    /**
     * Gets the definition of this row type reference.
     *
     * @return IRowType the definition of this row type reference
     */
    public function RowDefinition(): IRowType
    {
        /**
         * @var IRowTypeReference $this
         */
        $definition = $this->getDefinition();
        assert($definition instanceof IRowType, 'Row Type Referenes should always wrap a Row Type');
        return $definition;
    }
}
