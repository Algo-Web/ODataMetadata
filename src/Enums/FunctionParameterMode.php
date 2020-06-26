<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmFunctionParameterMode.
 *
 * Enumerates the modes of parameters of EDM functions.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static self None() Denotes that a parameter with an unknown or error directionality.
 * @method bool isNone()
 * @method static self In() Denotes that a parameter is used for input.
 * @method bool isIn()
 * @method static self Out() Denotes that a parameter is used for output.
 * @method bool isOut()
 * @method static self InOut() Denotes that a parameter is used for input and output.
 * @method bool isInOut()
 */
class FunctionParameterMode extends Enum
{
    protected const None  = 0;
    protected const In    = 1;
    protected const Out   = 2;
    protected const InOut = 3;
}
