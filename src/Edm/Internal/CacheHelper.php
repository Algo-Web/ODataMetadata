<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Internal;

use stdClass;

/**
 * Helper for Cache class.
 * @package AlgoWeb\ODataMetadata\Edm\Internal
 * @internal
 */
class CacheHelper
{
    public static function getUnknown(): ?stdClass
    {
        return null;
    }
    public static function getCycleSentinel(): ?stdClass
    {
        return (object)[];
    }
    public static function getSecondPassCycleSentinel(): ?stdClass
    {
        return (object)[];
    }
    public static function GetBoxed(bool $value)
    {
        return $value;
    }
}
