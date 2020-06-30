<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Edm\Validation\ObjectLocation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ILocatable;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;

/**
 * Trait EdmElementHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait EdmElementHelpers
{
    /**
     * Gets the location of this element.
     *
     * @return ILocation|null the location of the element
     */
    public function Location(): ?ILocation
    {
        return $this instanceof ILocatable && $this->getLocation() !== null ? $this->getLocation() : new ObjectLocation($this);
    }

    public function getErrors(): iterable
    {
        /**
         * @var IEdmElement $this
         */
        return InterfaceValidator::GetStructuralErrors($this);
    }
}
