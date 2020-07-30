<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Library\EdmEntityTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleBaseToString;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleICheckable;

/**
 * Class BadEntityTypeReference.
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadEntityTypeReference extends EdmEntityTypeReference implements ICheckable
{
    use SimpleICheckable;
    use SimpleBaseToString;

    /**
     * BadEntityTypeReference constructor.
     * @param string     $qualifiedName
     * @param bool       $isNullable
     * @param EdmError[] $errors
     */
    public function __construct(string $qualifiedName, bool $isNullable, array $errors)
    {
        parent::__construct(new BadEntityType($qualifiedName, $errors), $isNullable);
        $this->errors = $errors;
    }
}
