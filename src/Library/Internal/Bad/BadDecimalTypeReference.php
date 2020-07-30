<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Library\EdmDecimalTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleBaseToString;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleICheckable;

class BadDecimalTypeReference extends EdmDecimalTypeReference implements ICheckable
{
    use SimpleICheckable;
    use SimpleBaseToString;
    /**
     * BadDecimalTypeReference constructor.
     * @param string     $qualifiedName
     * @param bool       $isNullable
     * @param EdmError[] $errors
     */
    public function __construct(string $qualifiedName, bool $isNullable, array $errors)
    {
        parent::__construct(new BadPrimitiveType($qualifiedName, PrimitiveTypeKind::Decimal(), $errors), $isNullable, null, null);
        $this->errors = $errors;
    }
}
