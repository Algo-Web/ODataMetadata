<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmDocumentation
 *
 * Represents an EDM documentation.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IDocumentation
{
    /**
     * @return string Gets a summary of this documentation.
     */
    public function getSummary(): string;

    /**
     * @return string Gets a long description of this documentation.
     */
    public function getDescription(): string;
}