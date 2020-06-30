<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Helpers\CollectionTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IType;

/**
 * Represents a reference to an EDM collection type.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmCollectionTypeReference extends EdmTypeReference implements ICollectionTypeReference
{
    use CollectionTypeReferenceHelpers;

    /**
     * Initializes a new instance of the EdmCollectionTypeReference class.
     *
     * @param ICollectionType $collectionType the type definition this reference refers to
     * @param bool            $isNullable     denotes whether the type can be nullable
     */
    public function __construct(ICollectionType $collectionType, bool $isNullable)
    {
        parent::__construct($collectionType, $isNullable);
    }

    /**
     * @return bool gets a value indicating whether this type is nullable
     */
    public function getNullable(): bool
    {
        return parent::getNullable();
    }

    /**
     * @return IType|null gets the definition to which this type refers
     */
    public function getDefinition(): ?IType
    {
        return parent::getDefinition();
    }
}
