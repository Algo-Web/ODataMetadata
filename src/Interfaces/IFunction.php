<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmFunction
 *
 * Represents an EDM function.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IFunction extends IFunctionBase, ISchemaElement
{
    /**
     * @return string Gets the defining expression of this function.
     */
    public function getDefiningExpression(): string;
}