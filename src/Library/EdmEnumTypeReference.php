<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Helpers\EnumTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;

/**
 * Represents a reference to an EDM enumeration type.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmEnumTypeReference extends EdmTypeReference implements IEnumTypeReference
{
    use EnumTypeReferenceHelpers;

    /**
     * Initializes a new instance of the EdmEnumTypeReference class.
     * @param IEnumType $definition The definition refereed to by this reference.
     * @param bool $isNullable Denotes whether the type can be nullable.
     */
    public function __construct(IEnumType $definition, bool $isNullable)
    {
        parent::__construct($definition, $isNullable);
    }

}