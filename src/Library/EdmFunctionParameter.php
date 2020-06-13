<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Represents an EDM function parameter.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmFunctionParameter extends EdmNamedElement implements IFunctionParameter
{
    /**
     * @var ITypeReference
     */
    private $type;
    /**
     * @var FunctionParameterMode
     */
    private $mode;
    /**
     * @var IFunctionBase
     */
    private $declaringFunction;

    /**
     * Initializes a new instance of the EdmFunctionParameter class.
     *
     * @param IFunctionBase $declaringFunction Declaring function of the parameter.
     * @param string $name Name of the parameter.
     * @param ITypeReference $type Type of the parameter.
     * @param FunctionParameterMode|null $mode Mode of the parameter.
     */
    public function __construct(IFunctionBase $declaringFunction, string $name, ITypeReference $type, FunctionParameterMode $mode = null)
    {
        parent::__construct($name);
        $mode = $mode ?? FunctionParameterMode::In();
        $this->type = $type;
        $this->mode = $mode;
        $this->declaringFunction = $declaringFunction;
    }

    /**
     * @return ITypeReference Gets the type of this function parameter.
     */
    public function getType(): ITypeReference
    {
        return $this->type;
    }

    /**
     * @return IFunctionBase Gets the function or function import that declared this parameter.
     */
    public function getDeclaringFunction(): IFunctionBase
    {
        return $this->declaringFunction;
    }

    /**
     * @return FunctionParameterMode Gets the mode of this function parameter.
     */
    public function getMode(): FunctionParameterMode
    {
        return $this->mode;
    }
}