<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmEntityReferenceType.
 *
 * Represents a definition of an EDM entity reference type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IEntityReferenceType extends IType
{
    /**
     * @return IEntityType gets the entity type pointed to by this entity reference
     */
    public function getEntityType(): IEntityType;
}
