<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\FunctionImportHelpers;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\IFunctionImportHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;

/**
 * Class IEdmFunctionImport.
 *
 * Represents an EDM function import.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IFunctionImport extends IFunctionBase, IEntityContainerElement, IFunctionImportHelpers
{
    /**
     * @return bool Gets a value indicating whether this function import has side-effects.
     *              isSideEffecting cannot be return true if isComposable also returns true
     */
    public function isSideEffecting(): bool;

    /**
     * @return bool gets a value indicating whether this function import can be composed inside expressions
     */
    public function isComposable(): bool;

    /**
     * @return bool gets a value indicating whether this function import can be used as an extension method for the
     *              type of the first parameter of this function import
     */
    public function isBindable(): bool;

    /**
     * @return IExpression|null gets the entity set containing entities returned by this function import
     */
    public function getEntitySet(): ?IExpression;
}
