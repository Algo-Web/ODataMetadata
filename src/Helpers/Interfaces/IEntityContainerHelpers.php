<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

/**
 * Trait EntityContainerHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IEntityContainerHelpers
{
    /**
     * Returns entity sets belonging to an IEdmEntityContainer.
     *
     * @return IEntitySet[] entity sets belonging to an IEdmEntityContainer
     */
    public function EntitySets(): array;

    /**
     * Returns function imports belonging to an IEdmEntityContainer.
     *
     * @return IFunctionImport[] function imports belonging to an IEdmEntityContainer
     */
    public function FunctionImports(): array;
}