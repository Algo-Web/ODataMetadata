<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;

/**
 * Interface IEdmEntityContainerElement.
 *
 * Represents the common elements of all EDM entity container elements.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IEntityContainerElement extends INamedElement, IVocabularyAnnotatable
{
    /**
     * @return ContainerElementKind gets the kind of element of this container element
     */
    public function getContainerElementKind(): ContainerElementKind;

    /**
     * @return IEntityContainer|null gets the container that contains this element
     */
    public function getContainer(): ?IEntityContainer;
}
