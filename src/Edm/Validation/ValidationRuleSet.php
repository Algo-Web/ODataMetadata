<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation;


use AlgoWeb\ODataMetadata\Version;

class ValidationRuleSet
{
    public function __construct(array $rules)
    {
    }

    public static function getEdmModelRuleSet(Version $versionOrRuleset): self
    {
        return new self([]);
    }
}