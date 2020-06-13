<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Library\EdmStringTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleBaseToString;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleICheckable;

/**
 * Represents a reference to a semantically invalid EDM string type.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadStringTypeReference extends EdmStringTypeReference implements ICheckable
{
    use SimpleICheckable;
    use SimpleBaseToString;

    /**
     * BadStringTypeReference constructor.
     * @param string $qualifiedName
     * @param bool $isNullable
     * @param EdmError[] $errors
     */
    public function __construct(string $qualifiedName, bool $isNullable, array $errors)
    {
        parent::__construct(
            new BadPrimitiveType(
                $qualifiedName,
                PrimitiveTypeKind::String(),
                $errors
            ),
            $isNullable,
            false,
            null,
            false,
            false,
            null
        );
        $this->errors = $errors;
    }

}