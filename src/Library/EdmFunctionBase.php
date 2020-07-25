<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Helpers\VocabularyAnnotatableHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Represents a base class for EDM functions and function imports.
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmFunctionBase extends EdmNamedElement implements IFunctionBase
{
    use VocabularyAnnotatableHelpers;

    /**
     * @var IFunctionParameter[]
     */
    private $parameters = [];
    /**
     * @var ITypeReference|null
     */
    private $returnType;

    /**
     * Initializes a new instance of the EdmFunctionBase class.
     *
     * @param string         $name       the name of the function
     * @param ITypeReference $returnType the return type of the function
     */
    public function __construct(string $name, ?ITypeReference $returnType)
    {
        parent::__construct($name);
        $this->returnType = $returnType;
    }

    /**
     * Gets the return type of this function.
     *
     * @return ITypeReference
     */
    public function getReturnType(): ITypeReference
    {
        return $this->returnType;
    }

    /**
     * Gets the collection of parameters for this function.
     *
     * @return IFunctionParameter[]|null
     */
    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    /**
     * Searches for a parameter with the given name, and returns null if no such parameter exists.
     *
     * @param  string                  $name the name of the parameter being found
     * @return IFunctionParameter|null the requested parameter or null if no such parameter exists
     */
    public function findParameter(string $name): ?IFunctionParameter
    {
        foreach ($this->parameters as $parameter) {
            if ($parameter->getName() === $name) {
                return $parameter;
            }
        }
        return null;
    }

    /**
     * Creates and adds a parameter to this function (as the last parameter).
     *
     * @param  string                     $name the name of the parameter being added
     * @param  ITypeReference             $type the type of the parameter being added
     * @param  FunctionParameterMode|null $mode mode of the parameter
     * @return EdmFunctionParameter       created parameter
     */
    public function addParameter(string $name, ITypeReference $type, ?FunctionParameterMode $mode = null): EdmFunctionParameter
    {
        $parameter          = new EdmFunctionParameter($this, $name, $type, $mode);
        $this->parameters[] = $parameter;
        return $parameter;
    }

    /**
     * Adds a parameter to this function (as the last parameter).
     *
     * @param IFunctionParameter $parameter the parameter being added
     */
    public function addRawParameter(IFunctionParameter $parameter): void
    {
        $this->parameters[] = $parameter;
    }
}
