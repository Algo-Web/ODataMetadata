<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmNamedElement.
 *
 * Common base interface for all named EDM elements.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface INamedElement extends IEdmElement
{
    /**
     * @return string|null gets the name of this element
     */
    public function getName(): ?string;
}
