<?php


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;

/**
 * Trait EntityContainerHelpers
 * @package AlgoWeb\ODataMetadata\Helpers
 * @mixin IEntityContainer
 */
trait EntityContainerHelpers
{
    /**
     * Returns entity sets belonging to an IEdmEntityContainer.
     *
     * @return IEntitySet[] Entity sets belonging to an IEdmEntityContainer.
     */
    public function EntitySets(): array{
        return array_filter($this->getElements(), function(IEntityContainerElement $item){
            return $item instanceof IEntitySet;
        });
    }

    /**
     * Returns function imports belonging to an IEdmEntityContainer.
     *
     * @return IFunctionImport[] Function imports belonging to an IEdmEntityContainer.
     */
    public function FunctionImports(): array
    {
        return array_filter($this->getElements(), function(IEntityContainerElement $item){
            return $item instanceof IFunctionImport;
        });
    }


}