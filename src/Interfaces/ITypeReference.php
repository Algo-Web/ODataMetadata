<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\EdmElementHelpers;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\ITypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Helpers\TypeReferenceHelpers;

/**
 * Interface IEdmTypeReference.
 *
 *  Represents a references to a type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface ITypeReference extends IEdmElement, ITypeReferenceHelpers
{
    /**
     * @return bool gets a value indicating whether this type is nullable
     */
    public function getNullable(): bool;

    /**
     * @return IType|null gets the definition to which this type refers
     */
    public function getDefinition(): ?IType;
}
