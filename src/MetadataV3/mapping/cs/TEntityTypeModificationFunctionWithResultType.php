<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\Groups\TResultBindingGroup;

/**
 * Class representing TEntityTypeModificationFunctionWithResultType
 *
 * Extensions to modification function for entity type InsertFunction and UpdateFunction
 *
 * XSD Type: TEntityTypeModificationFunctionWithResult
 */
class TEntityTypeModificationFunctionWithResultType extends TEntityTypeModificationFunctionType
{
    use TResultBindingGroup;

    public function isOK(&$msg = null)
    {
        $result = parent::isOK($msg);
        if ($result) {
            if (!$this->isResultBindingGroupOK($msg)) {
                return false;
            }
        }
        return $result;
    }
}
