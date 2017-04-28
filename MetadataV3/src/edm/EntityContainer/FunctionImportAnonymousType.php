<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer;
/**
 * Class representing FunctionImportAnonymousType
 */
class FunctionImportAnonymousType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType[] $returnType
     */
    private $returnType = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType $entitySet
     */
    private $entitySet = null;

    /**
     * @property boolean $isComposable
     */
    private $isComposable = null;

    /**
     * @property boolean $isSideEffecting
     */
    private $isSideEffecting = null;

    /**
     * @property boolean $isBindable
     */
    private $isBindable = null;

    /**
     * @property string $methodAccess
     */
    private $methodAccess = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType[] $parameter
     */
    private $parameter = array(
        
    );

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
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Adds as returnType
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType $returnType
     */
    public function addToReturnType(TFunctionImportReturnTypeType $returnType)
    {
        $this->returnType[] = $returnType;
        return $this;
    }

    /**
     * isset returnType
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetReturnType($index)
    {
        return isset($this->returnType[$index]);
    }

    /**
     * unset returnType
     *
     * @param scalar $index
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
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType[] $returnType
     * @return self
     */
    public function setReturnType(array $returnType)
    {
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
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType $entitySet
     * @return self
     */
    public function setEntitySet(TOperandType $entitySet)
    {
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
     * @param boolean $isComposable
     * @return self
     */
    public function setIsComposable($isComposable)
    {
        $this->isComposable = $isComposable;
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
     * @param boolean $isSideEffecting
     * @return self
     */
    public function setIsSideEffecting($isSideEffecting)
    {
        $this->isSideEffecting = $isSideEffecting;
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
     * @param boolean $isBindable
     * @return self
     */
    public function setIsBindable($isBindable)
    {
        $this->isBindable = $isBindable;
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
     * @param string $methodAccess
     * @return self
     */
    public function setMethodAccess($methodAccess)
    {
        $this->methodAccess = $methodAccess;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as parameter
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType $parameter
     */
    public function addToParameter(TFunctionImportParameterType $parameter)
    {
        $this->parameter[] = $parameter;
        return $this;
    }

    /**
     * isset parameter
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetParameter($index)
    {
        return isset($this->parameter[$index]);
    }

    /**
     * unset parameter
     *
     * @param scalar $index
     * @return void
     */
    public function unsetParameter($index)
    {
        unset($this->parameter[$index]);
    }

    /**
     * Gets as parameter
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType[]
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType[] $parameter
     * @return self
     */
    public function setParameter(array $parameter)
    {
        $this->parameter = $parameter;
        return $this;
    }
}
