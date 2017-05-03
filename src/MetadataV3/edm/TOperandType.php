<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GExpressionTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GInlineExpressionsTrait;

/**
 * Class representing TOperandType
 *
 *
 * XSD Type: TOperand
 */
class TOperandType extends IsOK
{
    use GInlineExpressionsTrait, GExpressionTrait;

    public function __construct()
    {
        $this->gExpressionMaximum = 1;
    }
    
    public function isOK(&$msg = null)
    {
        if (!$this->isGInlineExpressionsValid($msg)) {
            return false;
        }

        return true;
    }
}
