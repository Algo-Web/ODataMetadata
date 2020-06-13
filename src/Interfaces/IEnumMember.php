<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\EnumMemberHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;

/**
 * Interface IEdmEnumMember.
 *
 * Represents a definition of an EDM enumeration type member.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 * @mixin EnumMemberHelpers
 */
interface IEnumMember extends INamedElement
{
    /**
     * @return IPrimitiveValue gets the value of this enumeration type member
     */
    public function getValue(): IPrimitiveValue;

    /**
     * @return IEnumType gets the type that this member belongs to
     */
    public function getDeclaringType(): IEnumType;
}
