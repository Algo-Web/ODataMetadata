<?php
namespace AlgoWeb\ODataMetadata;

use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;

abstract class IsOK
{
    use IsOKToolboxTrait;

    protected static $v3QualifiedNameCache = [];
    protected static $v3QualifiedNameRegex =
        '/[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}(\.[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}){0,}/';

    abstract public function isOK(&$msg = null);

    public function isStructureOK(&$msg = null)
    {
        return true;
    }
}
