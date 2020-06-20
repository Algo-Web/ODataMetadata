<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\INavigationTargetMapping;

/**
 * Represents a semantically invalid EDM entity set.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadEntitySet extends BadElement implements IEntitySet
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var IEntityContainer
     */
    private $container;

    /**
     * BadEntitySet constructor.
     * @param string|null      $name
     * @param IEntityContainer $container
     * @param array            $errors
     */
    public function __construct(?string $name, IEntityContainer $container, array $errors)
    {
        parent::__construct($errors);
        $this->name      = $name ?? '';
        $this->container = $container;
    }

    /**
     * @return ContainerElementKind gets the kind of element of this container element
     */
    public function getContainerElementKind(): ContainerElementKind
    {
        return ContainerElementKind::EntitySet();
    }

    /**
     * @return IEntityContainer|null gets the container that contains this element
     */
    public function getContainer(): ?IEntityContainer
    {
        return $this->container;
    }

    /**
     * @return IEntityType gets the entity type contained in this entity set
     */
    public function getElementType(): IEntityType
    {
        return new BadEntityType('', $this->getErrors());
    }

    /**
     * @return array|INavigationTargetMapping[] gets the navigation targets of this entity set
     */
    public function getNavigationTargets(): array
    {
        return [];
    }

    /**
     * Finds the entity set that a navigation property targets.
     *
     * @param  INavigationProperty $navigationProperty the navigation property
     * @return IEntitySet          the entity set that the navigation property targets, or null if no such entity set exists
     */
    public function findNavigationTarget(INavigationProperty $navigationProperty): ?IEntitySet
    {
        return null;
    }

    /**
     * @return string|null gets the name of this element
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
