<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;

/**
 * Trait PrimitiveTypeHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IPrimitiveTypeHelpers
{
    public function getPrimitiveTypeReference(bool $isNullable): IPrimitiveTypeReference;
}
