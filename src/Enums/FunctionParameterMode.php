<?php


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmFunctionParameterMode
 *
 * Enumerates the modes of parameters of EDM functions.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static None(): self Denotes that a parameter with an unknown or error directionality.
 * @method static In(): self Denotes that a parameter is used for input.
 * @method static Out(): self Denotes that a parameter is used for output.
 * @method static InOut(): self Denotes that a parameter is used for input and output.

 */
class FunctionParameterMode extends Enum
{
    protected const None = "";
    protected const In = "In";
    protected const Out = "Out";
    protected const InOut = "InOut";
}