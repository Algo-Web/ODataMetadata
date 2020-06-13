<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Helpers\ToTraceString;
use AlgoWeb\ODataMetadata\Helpers\TypeHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IType;

abstract class EdmType extends EdmElement implements IType
{
    use TypeHelpers;
    public function __toString(): string
    {
        return ToTraceString::ToTraceString($this);
    }
}