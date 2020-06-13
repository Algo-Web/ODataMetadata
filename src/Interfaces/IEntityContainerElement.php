<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;

/**
 * Interface IEdmEntityContainerElement
 *
 * Represents the common elements of all EDM entity container elements.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IEntityContainerElement extends INamedElement, IVocabularyAnnotatable
{
    /**
     * @return ContainerElementKind Gets the kind of element of this container element.
     */
    public function getContainerElementKind(): ContainerElementKind;

    /**
     * @return IEntityContainer|null Gets the container that contains this element.
     */
    public function getContainer(): ?IEntityContainer;
}