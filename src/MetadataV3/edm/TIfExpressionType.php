<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GExpressionTrait;

/**
 * Class representing TIfExpressionType
 *
 *
 * XSD Type: TIfExpression
 */
class TIfExpressionType extends IsOK
{
    //Test, IfTrue, IfFalse
    
    use GExpressionTrait;
    
    public function __construct()
    {
        $this->gExpressionMaximum = 3;
        $this->gExpressionMinimum = 3;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isGExpressionValid($msg)) {
            return false;
        }
        return true;
    }
}
