<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;

interface IFunctionParameter extends INamedElement, IVocabularyAnnotatable
{
    /**
     * @return ITypeReference gets the type of this function parameter
     */
    public function getType(): ITypeReference;

    /**
     * @return IFunctionBase gets the function or function import that declared this parameter
     */
    public function getDeclaringFunction(): IFunctionBase;

    /**
     * @return FunctionParameterMode gets the mode of this function parameter
     */
    public function getMode(): FunctionParameterMode;
}
