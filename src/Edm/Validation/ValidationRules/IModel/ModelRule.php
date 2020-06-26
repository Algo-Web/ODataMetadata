<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IModel;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IModel;

abstract class ModelRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IModel::class;
    }
}