<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Trait CollectionTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait CollectionTypeReferenceHelpers
{
    /**
     * Gets the definition of this collection reference.
     *
     * @return ICollectionType the definition of this collection reference
     */
    public function CollectionDefinition(): ICollectionType
    {
        $definition = $this->getDefinition();
        assert($definition instanceof ICollectionType, 'Collection Type Reference should always wrap a Collection Type');
        return $definition;
    }

    /**
     * Gets the element type of the definition of this collection reference.
     *
     * @return ITypeReference The element type of the definition of this collection reference
     */
    public function ElementType(): ITypeReference
    {
        return $this->CollectionDefinition()->getElementType();
    }

    abstract public function getDefinition(): ?IType;
}
