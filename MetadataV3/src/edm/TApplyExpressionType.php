<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;
/**
 * Class representing TApplyExpressionType
 *
 *
 * XSD Type: TApplyExpression
 */
class TApplyExpressionType
{

    /**
     * @property string $function
     */
    private $function = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType\AppliedFunctionAnonymousType[]
     * $appliedFunction
     */
    private $appliedFunction = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType\ArgumentsAnonymousType[]
     * $arguments
     */
    private $arguments = array(
        
    );

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
     * @param string $function
     * @return self
     */
    public function setFunction($function)
    {
        $this->function = $function;
        return $this;
    }

    /**
     * Adds as appliedFunction
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType\AppliedFunctionAnonymousType
     * $appliedFunction
     */
    public function addToAppliedFunction(TApplyExpressionType\AppliedFunctionAnonymousType $appliedFunction)
    {
        $this->appliedFunction[] = $appliedFunction;
        return $this;
    }

    /**
     * isset appliedFunction
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetAppliedFunction($index)
    {
        return isset($this->appliedFunction[$index]);
    }

    /**
     * unset appliedFunction
     *
     * @param scalar $index
     * @return void
     */
    public function unsetAppliedFunction($index)
    {
        unset($this->appliedFunction[$index]);
    }

    /**
     * Gets as appliedFunction
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType\AppliedFunctionAnonymousType[]
     */
    public function getAppliedFunction()
    {
        return $this->appliedFunction;
    }

    /**
     * Sets a new appliedFunction
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType\AppliedFunctionAnonymousType[]
     * $appliedFunction
     * @return self
     */
    public function setAppliedFunction(array $appliedFunction)
    {
        $this->appliedFunction = $appliedFunction;
        return $this;
    }

    /**
     * Adds as arguments
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType\ArgumentsAnonymousType $arguments
     */
    public function addToArguments(TApplyExpressionType\ArgumentsAnonymousType $arguments)
    {
        $this->arguments[] = $arguments;
        return $this;
    }

    /**
     * isset arguments
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetArguments($index)
    {
        return isset($this->arguments[$index]);
    }

    /**
     * unset arguments
     *
     * @param scalar $index
     * @return void
     */
    public function unsetArguments($index)
    {
        unset($this->arguments[$index]);
    }

    /**
     * Gets as arguments
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType\ArgumentsAnonymousType[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Sets a new arguments
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType\ArgumentsAnonymousType[] $arguments
     * @return self
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
        return $this;
    }
}
