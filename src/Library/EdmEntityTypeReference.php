<?php


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Helpers\EntityTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;

class EdmEntityTypeReference extends EdmTypeReference implements IEntityTypeReference
{
    use EntityTypeReferenceHelpers;

    /**
     * Initializes a new instance of the EdmEntityTypeReference class.
     *
     * @param IEntityType $definition The definition refereed to by this reference.
     * @param bool $isNullable Denotes whether the type can be nullable.
     */
    public function __construct(IEntityType $definition, bool $isNullable)
    {
        parent::__construct($definition, $isNullable);
    }

}