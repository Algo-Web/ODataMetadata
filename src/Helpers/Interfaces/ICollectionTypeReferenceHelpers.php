<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Trait CollectionTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface ICollectionTypeReferenceHelpers
{
    /**
     * Gets the definition of this collection reference.
     *
     * @return ICollectionType the definition of this collection reference
     */
    public function CollectionDefinition(): ICollectionType;

    /**
     * Gets the element type of the definition of this collection reference.
     *
     * @return ITypeReference The element type of the definition of this collection reference
     */
    public function ElementType(): ITypeReference;
}