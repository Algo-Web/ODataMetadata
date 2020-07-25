<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;

/**
 * Defines an Edm component who is invalid or whose validity is unknown at construction.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface ICheckable
{
    /**
     * @return EdmError[]|null gets an error if one exists with the current object
     */
    public function getErrors(): ?iterable;
}
