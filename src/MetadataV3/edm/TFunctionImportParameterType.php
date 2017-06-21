<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GEmptyElementExtensibilityTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TFunctionImportParameterAttributesTrait;

/**
 * Class representing TFunctionImportParameterType
 *
 * XSD Type: TFunctionImportParameter
 */
class TFunctionImportParameterType extends IsOK
{
    use GEmptyElementExtensibilityTrait, TFunctionImportParameterAttributesTrait;
    
    public function isOK(&$msg = null)
    {
        if (!$this->isExtensibilityElementOK($msg)) {
            return false;
        }
        if (!$this->isTFunctionImportParameterAttributesValid($msg)) {
            return false;
        }
        return true;
    }
}
