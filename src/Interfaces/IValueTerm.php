<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmValueTerm.
 *
 * Represents an EDM value term.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IValueTerm extends ISchemaElement, ITerm
{
    /**
     * @return ITypeReference|null gets the type of this term
     */
    public function getType(): ?ITypeReference;
}
