<?php


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Helpers\ComplexTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IComplexTypeReference;

/**
 * Represents a reference to an EDM complex type.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmComplexTypeReference extends EdmTypeReference implements IComplexTypeReference
{
    use ComplexTypeReferenceHelpers;

    /**
     * Initializes a new instance of the EdmComplexTypeReference class.
     * @param IComplexType $definition The type definition this reference refers to.
     * @param bool $isNullable Denotes whether the type can be nullable.
     */
    public function __construct(IComplexType $definition, bool $isNullable)
    {
        parent::__construct($definition, $isNullable);
    }
}