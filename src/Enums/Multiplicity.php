<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmMultiplicity.
 *
 * Enumerates the multiplicities of EDM navigation properties.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static self Unknown(): self The Multiplicity of the association end is unknown.
 * @method bool isUnknown()
 * @method static self ZeroOrOne(): self The Multiplicity of the association end is zero or one.
 * @method bool isZeroOrOne()
 * @method static self One(): self The Multiplicity of the association end is one.
 * @method bool isOne()
 * @method static self Many(): self The Multiplicity of the association end is many.
 * @method bool isMany()
 */
class Multiplicity extends Enum
{
    protected const Unknown     = '';
    protected const ZeroOrOne   = '0..1';
    protected const One         = '1';
    protected const Many        = '*';
}
