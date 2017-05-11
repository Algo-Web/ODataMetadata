<?php
namespace AlgoWeb\ODataMetadata;

use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;

abstract class IsOK
{
    use IsOKToolboxTrait;

    abstract public function isOK(&$msg = null);

    public function isStructureOK(&$msg = null)
    {
        return true;
    }
}
