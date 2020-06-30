<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Visitor;

use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;

interface IFunctionRelatedVisitor
{
    public function startFunction(IFunction $function): void;
    public function endFunction(IFunction $function): void;
    public function startFunctionImport(IFunctionImport $functionImport): void;
    public function endFunctionImport(IFunctionImport $functionImport): void;
    public function startFunctionBase(IFunctionBase $functionBase): void;
    public function endFunctionBase(IFunctionBase $functionBase): void;
    public function startFunctionParameter(IFunctionParameter $parameter): void;
    public function endFunctionParameter(IFunctionParameter $parameter): void;
}
