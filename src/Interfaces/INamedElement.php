<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmNamedElement
 *
 * Common base interface for all named EDM elements.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface INamedElement extends IEdmElement
{
    /**
     * @return string Gets the name of this element.
     */
    public function getName(): string;

}