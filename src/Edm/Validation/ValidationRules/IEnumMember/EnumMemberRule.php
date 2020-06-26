<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEnumMember;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;

abstract class EnumMemberRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IEnumMember::class;
    }
}