<?php


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmOnDeleteAction
 *
 * Enumerates the actions EDM can apply on deletes.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static None(): self Take no action on delete.
 * @method static Cascade(): self On delete also delete items on the other end of the association.
 */
class OnDeleteAction extends Enum
{
    protected const None    = "None";
    protected const Cascade = "Cascade";
}