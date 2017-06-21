<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;

/**
 * Class representing TEntitySetReferenceExpressionType
 *
 * XSD Type: TEntitySetReferenceExpression
 */
class TEntitySetReferenceExpressionType extends IsOK
{
    use IsOKToolboxTrait, TQualifiedNameTrait;
    /**
     * @property string $entitySet
     */
    private $entitySet = null;

    /**
     * Gets as entitySet
     *
     * @return string
     */
    public function getEntitySet()
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet
     *
     * @param  string $entitySet
     * @return self
     */
    public function setEntitySet($entitySet)
    {
        if (!$this->isTQualifiedNameValid($entitySet)) {
            $msg = "Entity set must be a valid TQualifiedName";
            throw new \InvalidArgumentException($msg);
        }
        $this->entitySet = $entitySet;
        return $this;
    }
    
    public function isOK(&$msg = null)
    {
        if (!$this->isTQualifiedNameValid($this->entitySet)) {
            $msg = "Entity set must be a valid TQualifiedName";
            return false;
        }
        return true;
    }
}
