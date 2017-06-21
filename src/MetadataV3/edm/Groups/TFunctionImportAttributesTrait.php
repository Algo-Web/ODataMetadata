<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\CodeGeneration\AccessTypeTraits;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType;

trait TFunctionImportAttributesTrait
{
    use TSimpleIdentifierTrait, AccessTypeTraits, IsOKToolboxTrait;
    
    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType[] $returnType
     */
    private $returnType = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType $entitySet
     */
    private $entitySet = null;

    /**
     * @property boolean $isComposable
     */
    private $isComposable = false;

    /**
     * @property boolean $isSideEffecting
     */
    private $isSideEffecting = true;

    /**
     * @property boolean $isBindable
     */
    private $isBindable = false;

    /**
     * @property string $methodAccess
     */
    private $methodAccess = null;

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
        $msg = null;
        if (!$this->isTSimpleIdentifierValid($name)) {
            $msg = "Name must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

    /**
     * Adds as returnType
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType $returnType
     */
    public function addToReturnType(TFunctionImportReturnTypeType $returnType)
    {
        $msg = null;
        if (!$returnType->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->returnType[] = $returnType;
        return $this;
    }

    /**
     * isset returnType
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetReturnType($index)
    {
        return isset($this->returnType[$index]);
    }

    /**
     * unset returnType
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetReturnType($index)
    {
        unset($this->returnType[$index]);
    }

    /**
     * Gets as returnType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType[]
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * Sets a new returnType
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType[] $returnType
     * @return self
     */
    public function setReturnType(array $returnType)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $returnType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->returnType = $returnType;
        return $this;
    }

    /**
     * Gets as entitySet
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType
     */
    public function getEntitySet()
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType $entitySet
     * @return self
     */
    public function setEntitySet(TOperandType $entitySet)
    {
        $msg = null;
        if (!$entitySet->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entitySet = $entitySet;
        return $this;
    }

    /**
     * Gets as isComposable
     *
     * @return boolean
     */
    public function getIsComposable()
    {
        return $this->isComposable;
    }

    /**
     * Sets a new isComposable
     *
     * @param  boolean $isComposable
     * @return self
     */
    public function setIsComposable($isComposable)
    {
        $this->isComposable = boolval($isComposable);
        return $this;
    }

    /**
     * Gets as isSideEffecting
     *
     * @return boolean
     */
    public function getIsSideEffecting()
    {
        return $this->isSideEffecting;
    }

    /**
     * Sets a new isSideEffecting
     *
     * @param  boolean $isSideEffecting
     * @return self
     */
    public function setIsSideEffecting($isSideEffecting)
    {
        $this->isSideEffecting = boolval($isSideEffecting);
        return $this;
    }

    /**
     * Gets as isBindable
     *
     * @return boolean
     */
    public function getIsBindable()
    {
        return $this->isBindable;
    }

    /**
     * Sets a new isBindable
     *
     * @param  boolean $isBindable
     * @return self
     */
    public function setIsBindable($isBindable)
    {
        $this->isBindable = boolval($isBindable);
        return $this;
    }

    /**
     * Gets as methodAccess
     *
     * @return string
     */
    public function getMethodAccess()
    {
        return $this->methodAccess;
    }

    /**
     * Sets a new methodAccess
     *
     * @param  string $methodAccess
     * @return self
     */
    public function setMethodAccess($methodAccess)
    {
        $msg = null;
        if (null != $methodAccess && !$this->isTAccessOk($methodAccess)) {
            $msg = "Method access must be a valid TAccess";
            throw new \InvalidArgumentException($msg);
        }
        $this->methodAccess = $methodAccess;
        return $this;
    }
    
    
    public function isTFunctionImportAttributesValid(&$msg)
    {
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = "Name must be a valid TSimpleIdentifier: " . get_class($this);
            return false;
        }
        if ($this->isComposable && $this->isSideEffecting) {
            $msg = "Cannot both be composable and side-effecting";
            return false;
        }
        /*
        if (null != $this->entitySet && !$this->isTSimpleIdentifierValid($this->entitySet)) {
            $msg = "Entity set must be a valid TSimpleIdentifier";
            return false;
        }*/
        if (!$this->isObjectNullOrType('\AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType', $this->entitySet)) {
            $msg = "Entity set must be either null or an instance of TOperandType: " . get_class($this);
            return false;
        }
        if (null != $this->methodAccess && !$this->isTAccessOk($this->methodAccess)) {
            $msg = "Method access must be a valid TAccess: " . get_class($this);
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->returnType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType',
            $msg
        )
        ) {
            return false;
        }
        
        return true;
    }
}
