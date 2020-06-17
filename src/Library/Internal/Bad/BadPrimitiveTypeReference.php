<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Helpers\PrimitiveTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Library\EdmPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleICheckable;

class BadPrimitiveTypeReference extends EdmPrimitiveTypeReference implements ICheckable
{
    use PrimitiveTypeReferenceHelpers;
    use SimpleICheckable;

    /**
     * BadPrimitiveTypeReference constructor.
     * @param string|null     $qualifiedName
     * @param bool            $isNullable
     * @param EdmError[]      $errors
     */
    public function __construct(?string $qualifiedName, bool $isNullable, array $errors)
    {
        parent::__construct(new BadPrimitiveType($qualifiedName, PrimitiveTypeKind::None(), $errors), $isNullable);
        $this->errors = $errors;
    }
}
