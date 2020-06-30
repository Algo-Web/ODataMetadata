<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmEnumType.
 *
 * Represents a definition of an EDM enumeration type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IEnumType extends ISchemaType
{
    /**
     * @return IPrimitiveType gets the underlying type of this enumeration type
     */
    public function getUnderlyingType(): IPrimitiveType;

    /**
     * @return IEnumMember[] gets the members of this enumeration type
     */
    public function getMembers(): array;

    /**
     * @return bool gets a value indicating whether the enumeration type can be treated as a bit field
     */
    public function isFlags(): bool;
}
