<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TApplyExpressionType\AppliedFunctionAType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TApplyExpressionType\ArgumentsAType;

/**
 * Class representing TApplyExpressionType.
 *
 * 16.2.1 The Edm:Apply Expression
 *
 * The Edm:Apply expression enables a valueto be obtained by applying a client-side function. An apply expression MUST
 * assign a string value to the Edm:Function attribute. The value of the function attribute SHOULD be a
 * [qualifiedidentifier][csdl19]. The value of the function attribute is used to locate the client-side function that
 * should be applied.
 *
 * The Edm:Apply expression MUST contain zero or more expressions. The expressions contained within the apply
 * expression are used as parameters to the function.
 *
 * The apply expression MUST be written with element notation, as shown in the following example:
 *
 *     <ValueAnnotation Term="org.example.display.DisplayName">
 *         <Apply Function="org.example.commonfunctions.StringConcat">
 *             <String>Product</String>
 *             <String> </String>
 *             <String>Catalog</String>
 *         </Apply>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.2.1
 * @see https://docs.microsoft.com/en-us/openspecs/windows_protocols/mc-csdl/2ab2b71d-caa8-47cd-a870-9214f99df76c
 * XSD Type: TApplyExpression
 */
class TApplyExpressionType extends DynamicBase
{

    /**
     * @var string $function
     */
    private $function = null;

    /**
     * @var AppliedFunctionAType[] $appliedFunction
     */
    private $appliedFunction = [
        
    ];

    /**
     * @var ArgumentsAType[] $arguments
     */
    private $arguments = [
        
    ];

    /**
     * Gets as function.
     *
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Sets a new function.
     *
     * @param  string $function
     * @return self
     */
    public function setFunction($function)
    {
        $this->function = $function;
        return $this;
    }

    /**
     * Adds as appliedFunction.
     *
     * @param AppliedFunctionAType $appliedFunction
     *@return self
     */
    public function addToAppliedFunction(TApplyExpressionType\AppliedFunctionAType $appliedFunction)
    {
        $this->appliedFunction[] = $appliedFunction;
        return $this;
    }

    /**
     * isset appliedFunction.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetAppliedFunction($index)
    {
        return isset($this->appliedFunction[$index]);
    }

    /**
     * unset appliedFunction.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetAppliedFunction($index)
    {
        unset($this->appliedFunction[$index]);
    }

    /**
     * Gets as appliedFunction.
     *
     * @return AppliedFunctionAType[]
     */
    public function getAppliedFunction()
    {
        return $this->appliedFunction;
    }

    /**
     * Sets a new appliedFunction.
     *
     * @param  AppliedFunctionAType[] $appliedFunction
     * @return self
     */
    public function setAppliedFunction(array $appliedFunction)
    {
        $this->appliedFunction = $appliedFunction;
        return $this;
    }

    /**
     * Adds as arguments.
     *
     * @param ArgumentsAType $arguments
     *@return self
     */
    public function addToArguments(TApplyExpressionType\ArgumentsAType $arguments)
    {
        $this->arguments[] = $arguments;
        return $this;
    }

    /**
     * isset arguments.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetArguments($index)
    {
        return isset($this->arguments[$index]);
    }

    /**
     * unset arguments.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetArguments($index)
    {
        unset($this->arguments[$index]);
    }

    /**
     * Gets as arguments.
     *
     * @return ArgumentsAType[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Sets a new arguments.
     *
     * @param  ArgumentsAType[] $arguments
     * @return self
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
        return $this;
    }
}
