<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TFunctionReferenceExpressionType\ParameterAType;

/**
 * Class representing TFunctionReferenceExpressionType
 *
 * 16.2.6 The Edm:FunctionReference Expression
 *
 * The value of a Edm:FunctionReference is a reference to the return type of a function.
 *
 * The Edm:FunctionReference expression MUST contain a value of the type [qualifiedname][csdl19]. The value of the
 * function reference expression MUST resolve to a valid signature of a function.
 *
 * The Edm:FunctionReference expression MUST contain zero or more expressions. The expressions contained within the
 * function reference expression are used to determine which overload of the function is being referenced.
 *
 * The Edm:FunctionReference expression MUST be written with element notation, as shown in the following example:
 *
 *     <ValueAnnotation Term="org.example.person.Age">
 *         <FunctionReference Function="org.example.person.GetAge">
 *             <Path>BirthDate</Path>
 *         </FunctionReference>
 *     </ValueAnnotation>
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.2.6
 * XSD Type: TFunctionReferenceExpression
 */
class TFunctionReferenceExpressionType extends DynamicBase
{

    /**
     * @var string $function
     */
    private $function = null;

    /**
     * @var ParameterAType[] $parameter
     */
    private $parameter = [
        
    ];

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
     * Adds as parameter
     *
     * @param ParameterAType $parameter
     *@return self
     */
    public function addToParameter(TFunctionReferenceExpressionType\ParameterAType $parameter)
    {
        $this->parameter[] = $parameter;
        return $this;
    }

    /**
     * isset parameter
     *
     * @param int|string $index
     * @return bool
     */
    public function issetParameter($index)
    {
        return isset($this->parameter[$index]);
    }

    /**
     * unset parameter
     *
     * @param int|string $index
     * @return void
     */
    public function unsetParameter($index)
    {
        unset($this->parameter[$index]);
    }

    /**
     * Gets as parameter
     *
     * @return ParameterAType[]
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter
     *
     * @param ParameterAType[] $parameter
     * @return self
     */
    public function setParameter(array $parameter)
    {
        $this->parameter = $parameter;
        return $this;
    }


}

