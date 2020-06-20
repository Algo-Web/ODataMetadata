<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Represents a definition of an EDM collection type.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmCollectionType extends EdmType implements ICollectionType
{
    /**
     * @var ITypeReference
     */
    private $elementType;

    /**
     * Initializes a new instance of the EdmCollectionType class.
     *
     * @param ITypeReference $elementType the type of the elements in this collection
     */
    public function __construct(ITypeReference $elementType)
    {
        $this->elementType = $elementType;
    }

    /**
     * @return TypeKind gets the kind of this type
     */
    public function getTypeKind(): TypeKind
    {
        return TypeKind::Collection();
    }

    /**
     * @return ITypeReference|null gets the element type of this collection
     */
    public function getElementType(): ?ITypeReference
    {
        return $this->elementType;
    }
}
