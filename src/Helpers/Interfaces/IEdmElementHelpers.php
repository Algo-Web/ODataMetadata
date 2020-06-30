<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\ILocation;

/**
 * Trait EdmElementHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IEdmElementHelpers
{
    /**
     * Gets the location of this element.
     *
     * @return ILocation|null the location of the element
     */
    public function Location(): ?ILocation;

    public function getErrors(): iterable;
}
