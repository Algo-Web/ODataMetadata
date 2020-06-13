<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmMultiplicity.
 *
 * Enumerates the multiplicities of EDM navigation properties.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static Unknown(): self The Multiplicity of the association end is unknown.
 * @method static ZeroOrOne(): self The Multiplicity of the association end is zero or one.
 * @method static One(): self The Multiplicity of the association end is one.
 * @method static Many(): self The Multiplicity of the association end is many.
 */
class Multiplicity extends Enum
{
    protected const Unknown     = '';
    protected const ZeroOrOne   = '0..1';
    protected const One         = '1';
    protected const Many        = '*';
}
