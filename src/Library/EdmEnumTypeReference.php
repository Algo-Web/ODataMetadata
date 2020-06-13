<?php

declare(strict_types=1);


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
     * @param IEnumType $definition the definition refereed to by this reference
     * @param bool      $isNullable denotes whether the type can be nullable
     */
    public function __construct(IEnumType $definition, bool $isNullable)
    {
        parent::__construct($definition, $isNullable);
    }
}
