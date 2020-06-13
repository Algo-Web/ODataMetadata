<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmValueTerm
 *
 * Represents an EDM value term.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IValueTerm extends ISchemaElement, ITerm
{
    /**
     * @return ITypeReference Gets the type of this term.
     */
    public function getType(): ITypeReference;

}