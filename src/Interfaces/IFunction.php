<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmFunction.
 *
 * Represents an EDM function.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IFunction extends IFunctionBase, ISchemaElement
{
    /**
     * @return string|null gets the defining expression of this function
     */
    public function getDefiningExpression(): ?string;
}
