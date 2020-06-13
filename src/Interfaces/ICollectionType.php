<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmCollectionType.
 *
 * Represents a definition of an EDM collection type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface ICollectionType extends IType
{
    /**
     * @return ITypeReference gets the element type of this collection
     */
    public function getElementType(): ITypeReference;
}
