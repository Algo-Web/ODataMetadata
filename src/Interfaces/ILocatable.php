<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface ILocatable.
 *
 * Interface for all EDM elements that can be located.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces
 */
interface ILocatable
{
    /**
     * @return ILocation|null gets the location of this element
     */
    public function getLocation(): ?ILocation;
}
