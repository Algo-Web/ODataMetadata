<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\EntityContainerHelpers;

/**
 * Interface IEdmEntityContainer.
 *
 * Represents an EDM entity container.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 * @mixin EntityContainerHelpers
 */
interface IEntityContainer extends ISchemaElement
{
    /**
     * @return array|IEntityContainerElement[] gets a collection of the elements of this entity container
     */
    public function getElements(): array;

    public function isDefault(): ?bool;

    public function isLazyLoadEnabled(): ?bool;

    /**
     *  Searches for an entity set with the given name in this entity container and returns null if no such set exists.
     *
     * @param  string          $setName The name of the element being found
     * @return IEntitySet|null the requested element, or null if the element does not exist
     */
    public function findEntitySet(string $setName): ?IEntitySet;

    /**
     * Searches for function imports with the given name in this entity container and returns empty enumerable if no
     * such function import exists.
     *
     * @param  string                  $functionName the name of the function import being found
     * @return array|IFunctionImport[] a group of the requested function imports, or an empty enumerable if no such function import exists
     */
    public function findFunctionImports(string $functionName): array;
}
