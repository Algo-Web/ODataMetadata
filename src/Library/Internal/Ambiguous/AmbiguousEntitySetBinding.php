<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Ambiguous;

use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\INavigationTargetMapping;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadEntityType;

class AmbiguousEntitySetBinding extends AmbiguousBinding implements IEntitySet
{
    public function ambiguousEntitySetBinding(IEntitySet $first, IEntitySet $second)
    {
        parent::__construct($first, $second);
    }

    /**
     * Gets the kind of element of this container element.
     *
     * @return ContainerElementKind
     */
    public function getContainerElementKind(): ContainerElementKind
    {
        return ContainerElementKind::EntitySet();
    }

    /**
     *  Gets the container that contains this element.
     *
     * @return IEntityContainer|null
     */
    public function getContainer(): ?IEntityContainer
    {
        return 0 !== count($this->getBindings()) ? $this->getBindings()[0] : null;
    }

    /**
     * Gets the entity type contained in this entity set.
     *
     * @return IEntityType
     */
    public function getElementType(): IEntityType
    {
        return new BadEntityType('', iterable_to_array($this->getErrors()));
    }

    /**
     * Gets the navigation targets of this entity set.
     *
     * @return array|INavigationTargetMapping[]
     */
    public function getNavigationTargets(): array
    {
        return [];
    }

    /**
     * Finds the entity set that a navigation property targets.
     *
     * @param  INavigationProperty $navigationProperty the navigation property
     * @return IEntitySet|null     the entity set that the navigation property targets, or null if no such entity set exists
     */
    public function findNavigationTarget(INavigationProperty $navigationProperty): ?IEntitySet
    {
        return null;
    }
}
