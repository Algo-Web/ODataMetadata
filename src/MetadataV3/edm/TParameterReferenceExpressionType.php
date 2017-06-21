<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TParameterReferenceExpressionType
 *
 * XSD Type: TParameterReferenceExpression
 */
class TParameterReferenceExpressionType extends IsOK
{
    use IsOKToolboxTrait, TSimpleIdentifierTrait;
    /**
     * @property string $name
     */
    private $name = null;

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        if (!$this->isTSimpleIdentifierValid($name)) {
            $msg = "Name must be a valid TSimpleIdentifierValid";
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = "Name must be a valid TSimpleIdentifierValid";
            return false;
        }
        return true;
    }
}
