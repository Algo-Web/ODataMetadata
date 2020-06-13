<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmDocumentation.
 *
 * Represents an EDM documentation.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IDocumentation
{
    /**
     * @return string gets a summary of this documentation
     */
    public function getSummary(): string;

    /**
     * @return string gets a long description of this documentation
     */
    public function getDescription(): string;
}
