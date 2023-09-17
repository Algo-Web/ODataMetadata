<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Internal;

/**
 * Interface describing anything that can be depended upon in tracking semantic changes in an EDM model.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Internal
 */
interface IDependencyTrigger
{
    /**
     * @return array<IDependent>
     */
    public function getDependents(): array;
}
