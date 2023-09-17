<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;

/**
 * Class EdmNavigationPropertyInfo.
 *
 * Represents an EDM navigation property info used during construction of navigation properties.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
final class EdmNavigationPropertyInfo
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var IEntityType
     */
    public $target;
    /**
     * @var Multiplicity
     */
    public $targetMultiplicity;
    /**
     * @var IStructuralProperty[]
     */
    public $dependentProperties;
    /**
     * @var bool
     */
    public $containsTarget;

    public $onDelete;

    public function clone(): EdmNavigationPropertyInfo
    {
        return clone $this;
    }
}
