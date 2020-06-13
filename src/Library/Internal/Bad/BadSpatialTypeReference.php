<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Library\EdmSpatialTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleBaseToString;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleICheckable;

/**
 * Represents a reference to a semantically invalid EDM spatial type.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadSpatialTypeReference extends EdmSpatialTypeReference implements ICheckable
{
    use SimpleICheckable;
    use SimpleBaseToString;

    /**
     * BadSpatialTypeReference constructor.
     * @param string     $qualifiedName
     * @param bool       $isNullable
     * @param EdmError[] $errors
     */
    public function __construct(string $qualifiedName, bool $isNullable, array $errors)
    {
        parent::__construct(new BadPrimitiveType($qualifiedName, PrimitiveTypeKind::None(), $errors), $isNullable, null);
        $this->errors = $errors;
    }
}
