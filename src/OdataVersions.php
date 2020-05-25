<?php


declare(strict_types=1);

namespace AlgoWeb\ODataMetadata;

use MyCLabs\Enum\Enum;

/**
 * @method static ONE()
 * @method static TWO()
 * @method static THREE()
 */
class OdataVersions extends Enum
{
    private const ONE   = '1.0';
    private const TWO   = '2.0';
    private const THREE = '3.0';
}
