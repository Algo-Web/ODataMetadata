<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer\FunctionImport;


use MyCLabs\Enum\Enum;

/**
 * Class ParameterMode
 *
 * Parameter can define the Mod e of the parameter. Possible values are "In", "Out", and "InOut".
 * @method self In()
 * @method self Out()
 * @method self InOut()
 */
class ParameterMode extends Enum
{
    protected const In = "In";
    protected const Out = "Out";
    protected const InOut = "InOut";
}