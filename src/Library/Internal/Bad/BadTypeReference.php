<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;


use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Library\EdmTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleBaseToString;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleICheckable;

class BadTypeReference extends EdmTypeReference implements ICheckable
{
use SimpleICheckable;
use SimpleBaseToString;
    /**
     * BadTypeReference constructor.
     * @param BadType $definition
     * @param bool $isNullable
     */
    public function __construct(BadType $definition, bool $isNullable)
    {
        parent::__construct($definition, $isNullable);
        $this->errors = $definition->getErrors();
    }




}