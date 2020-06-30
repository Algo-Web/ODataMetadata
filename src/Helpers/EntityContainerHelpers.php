<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;

/**
 * Trait EntityContainerHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait EntityContainerHelpers
{
    /**
     * Returns entity sets belonging to an IEdmEntityContainer.
     *
     * @return IEntitySet[] entity sets belonging to an IEdmEntityContainer
     */
    public function EntitySets(): array
    {
        return array_filter($this->getElements(), function (IEntityContainerElement $item) {
            return $item instanceof IEntitySet;
        });
    }

    /**
     * Returns function imports belonging to an IEdmEntityContainer.
     *
     * @return IFunctionImport[] function imports belonging to an IEdmEntityContainer
     */
    public function FunctionImports(): array
    {
        return array_filter($this->getElements(), function (IEntityContainerElement $item) {
            return $item instanceof IFunctionImport;
        });
    }
}
