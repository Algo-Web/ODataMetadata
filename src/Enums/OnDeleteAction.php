<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmOnDeleteAction.
 *
 * Enumerates the actions EDM can apply on deletes.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static self None() Take no action on delete.
 * @method bool isNone()
 * @method static self Cascade() On delete also delete items on the other end of the association.
 * @method bool isCascade()
 */
class OnDeleteAction extends Enum
{
    protected const None    = 0;
    protected const Cascade = 1;
}
