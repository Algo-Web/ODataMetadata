<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;

/**
 * Class representing TFunctionReferenceExpressionType
 *
 * XSD Type: TFunctionReferenceExpression
 */
class TFunctionReferenceExpressionType extends IsOK
{
    use IsOKToolboxTrait, TQualifiedNameTrait;
    /**
     * @property string $function
     */
    private $function = null;

    /**
     * @property
     * \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType\ParameterAnonymousType[]
     * $parameter
     */
    private $parameter = [];

    /**
     * Gets as function
     *
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Sets a new function
     *
     * @param  string $function
     * @return self
     */
    public function setFunction($function)
    {
        if (!$this->isTQualifiedNameValid($function)) {
            $msg = "Function must be a valid TQualifiedName";
            throw new \InvalidArgumentException($msg);
        }
        $this->function = $function;
        return $this;
    }

    /**
     * Adds as parameter
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType\ParameterAnonymousType
     * $parameter
     */
    public function addToParameter(TFunctionReferenceExpressionType\ParameterAnonymousType $parameter)
    {
        $msg = null;
        if (!$parameter->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->parameter[] = $parameter;
        return $this;
    }

    /**
     * isset parameter
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetParameter($index)
    {
        return isset($this->parameter[$index]);
    }

    /**
     * unset parameter
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetParameter($index)
    {
        unset($this->parameter[$index]);
    }

    /**
     * Gets as parameter
     *
     * @return
     * \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType\ParameterAnonymousType[]
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType\ParameterAnonymousType[]
     * $parameter
     * @return self
     */
    public function setParameter(array $parameter)
    {
        if (!$this->isValidArrayOK(
            $parameter,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType\ParameterAnonymousType',
            $msg,
            1
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->parameter = $parameter;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTQualifiedNameValid($this->function)) {
            $msg = "Function must be a valid TQualifiedName";
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->function,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType\ParameterAnonymousType',
            $msg,
            1
        )
        ) {
            return false;
        }
        return true;
    }
}
