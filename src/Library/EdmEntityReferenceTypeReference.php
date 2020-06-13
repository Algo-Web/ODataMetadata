<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Helpers\EntityReferenceTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;

/**
 * Class EdmEntityReferenceTypeReference
 *
 * Represents a reference to an EDM entity reference type.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmEntityReferenceTypeReference extends EdmTypeReference implements IEntityReferenceTypeReference
{
    use EntityReferenceTypeReferenceHelpers;

    /**
     * Initializes a new instance of the EdmEntityReferenceTypeReference class.
     *
     * @param IEntityReferenceType $definition The definition referred to by this reference.
     * @param bool $isNullable Denotes whether the type can be nullable.
     */
    public function __construct(IEntityReferenceType $definition, bool $isNullable)
    {
        parent::__construct($definition, $isNullable);
    }
}