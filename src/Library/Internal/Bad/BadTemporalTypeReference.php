<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Library\EdmTemporalTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleBaseToString;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleICheckable;

/**
 * Represents a reference to a semantically invalid EDM temporal (Time, DateTime, DateTimeOffset) type.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadTemporalTypeReference extends EdmTemporalTypeReference implements ICheckable
{
    use SimpleICheckable;
    use SimpleBaseToString;
    public function __construct(string $qualifiedName, bool $isNullable, array $errors)
    {
        parent::__construct(
            new BadPrimitiveType(
                $qualifiedName,
                PrimitiveTypeKind::None(),
                $errors
            ),
            $isNullable,
            null
        );
        $this->errors = $errors;
    }
}
