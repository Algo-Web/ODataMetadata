<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Helpers\RowTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\IRowTypeReference;

class EdmRowTypeReference extends EdmTypeReference implements IRowTypeReference
{
    use RowTypeReferenceHelpers;
    public function __construct(IRowType $definition, bool $isNullable)
    {
        parent::__construct($definition, $isNullable);
    }

}