<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Helpers\RowTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Helpers\StructuredTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\IRowTypeReference;

class EdmRowTypeReference extends EdmTypeReference implements IRowTypeReference
{
    use RowTypeReferenceHelpers;
    use StructuredTypeReferenceHelpers;

    public function __construct(?IRowType $definition, bool $isNullable)
    {
        parent::__construct($definition, $isNullable);
    }
}
