<?php


namespace AlgoWeb\ODataMetadata\MetadataV3;


use MyCLabs\Enum\Enum;

/**
 * Class TMultiplicity
 *
 * The edm:Multiplicity attribute defines the cardinality of the association end. The value of the attribute MUST be
 * one of the following:
 * - 0..1 // zero or one
 * - 1 // exactly one
 * - * // zero or more
 *
 * @package AlgoWeb\ODataMetadata\MetadataV1
 */
class Multiplicity extends Enum
{
    protected const NullOne = "0..1";
    protected const One = "1";
    protected const Multi = "*";
}