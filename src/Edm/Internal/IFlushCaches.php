<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Internal;

/**
 * Interface describing anything that can have cached data that might need flushing.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Internal
 */
interface IFlushCaches
{
    public function flushCaches(): void;
}
