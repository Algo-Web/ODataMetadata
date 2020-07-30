<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Helpers\EntityTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Helpers\StructuredTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;

class EdmEntityTypeReference extends EdmTypeReference implements IEntityTypeReference
{
    use EntityTypeReferenceHelpers;
    use StructuredTypeReferenceHelpers;

    /**
     * Initializes a new instance of the EdmEntityTypeReference class.
     *
     * @param IEntityType $definition the definition refereed to by this reference
     * @param bool        $isNullable denotes whether the type can be nullable
     */
    public function __construct(IEntityType $definition, bool $isNullable)
    {
        parent::__construct($definition, $isNullable);
    }
}
