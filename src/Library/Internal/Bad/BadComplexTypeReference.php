<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Library\EdmComplexTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleBaseToString;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleICheckable;

class BadComplexTypeReference extends EdmComplexTypeReference implements ICheckable
{
    use SimpleICheckable;
    use SimpleBaseToString;

    /**
     * BadComplexTypeReference constructor.
     * @param string $qualifiedName
     * @param bool $isNullable
     * @param EdmError[] $errors
     */
    public function __construct(string $qualifiedName, bool $isNullable, array $errors)
    {
        parent::__construct(new BadComplexType($qualifiedName, $errors), $isNullable);
        $this->errors = $errors;
    }
}