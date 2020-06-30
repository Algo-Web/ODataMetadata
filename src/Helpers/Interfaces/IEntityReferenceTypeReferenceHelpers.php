<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;

/**
 * Trait EntityReferenceTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IEntityReferenceTypeReferenceHelpers
{
    /**
     * Gets the definition of this entity reference type reference.
     *
     * @return IEntityReferenceType the definition of this entity reference type reference
     */
    public function EntityReferenceDefinition(): IEntityReferenceType;

    /**
     * Gets the entity type referred to by the definition of this entity reference type reference.
     *
     * @return IEntityType the entity type referred to by the definition of this entity reference type reference
     */
    public function EntityType(): IEntityType;
}