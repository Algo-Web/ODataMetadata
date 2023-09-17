<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\OnAction;

use MyCLabs\Enum\Enum;

class ActionType extends Enum
{
    protected const Cascade = 'Cascade';
    protected const None = 'None';
}
