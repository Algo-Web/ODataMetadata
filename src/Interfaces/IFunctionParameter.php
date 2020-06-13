<?php


namespace AlgoWeb\ODataMetadata\Interfaces;


use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;

interface IFunctionParameter extends INamedElement, IVocabularyAnnotatable
{
    /**
     * @return ITypeReference Gets the type of this function parameter.
     */
    public function getType(): ITypeReference;

    /**
     * @return IFunctionBase Gets the function or function import that declared this parameter.
     */
    public function getDeclaringFunction(): IFunctionBase;

    /**
     * @return FunctionParameterMode Gets the mode of this function parameter.
     */
    public function getMode(): FunctionParameterMode;
}