<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Library\EdmBinaryTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleBaseToString;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleICheckable;

/**
 * Represents a reference to a semantically invalid EDM binary type.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadBinaryTypeReference extends EdmBinaryTypeReference implements ICheckable
{
    use SimpleICheckable;
    use SimpleBaseToString;
    public function __construct(string $qualifiedName, bool $isNullable, array $errors)
    {
        $this->errors = $errors;
        parent::__construct(new BadPrimitiveType($qualifiedName, PrimitiveTypeKind::Binary(), $errors), $isNullable, false, null, false);
    }
}
