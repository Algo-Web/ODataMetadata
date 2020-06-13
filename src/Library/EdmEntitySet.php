<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Edm\Internal\Cache;
use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\INavigationTargetMapping;
use SplObjectStorage;

class EdmEntitySet extends EdmNamedElement implements IEntitySet
{
    /**
     * @var IEntityContainer
     */
    private $container;
    /**
     * @var IEntityType
     */
    private $elementType;
    /**
     * @var array<INavigationProperty, IEntitySet>|SplObjectStorage()
     */
    private $navigationPropertyMappings = [];

    private $navigationTargetsCache = null;

    /**
     * Initializes a new instance of the EdmEntitySet class.
     *
     * @param IEntityContainer $container An IEntityContainer containing this entity set.
     * @param string $name Name of the entity set.
     * @param IEntityType $elementType The entity type of the elements in this entity set.
     */
    public function __construct(IEntityContainer $container, string $name, IEntityType $elementType)
    {
        parent::__construct($name);
        $this->navigationPropertyMappings = new SplObjectStorage();
        $this->navigationTargetsCache = new Cache(EdmEntitySet::class, 'array');
        $this->container = $container;
        $this->elementType = $elementType;
    }

    /**
     * @return ContainerElementKind Gets the kind of element of this container element.
     */
    public function getContainerElementKind(): ContainerElementKind
    {
        return ContainerElementKind::EntitySet();
    }

    /**
     * @return IEntityContainer|null Gets the container that contains this element.
     */
    public function getContainer(): ?IEntityContainer
    {
        return $this->container;
    }

    /**
     * @return IEntityType Gets the entity type contained in this entity set.
     */
    public function getElementType(): IEntityType
    {
        return $this->elementType;
    }

    /**
     * @return array|INavigationTargetMapping[] Gets the navigation targets of this entity set.
     */
    public function getNavigationTargets(): array
    {

        return $this->navigationTargetsCache->GetValue($this, \Closure::fromCallable([$this, 'ComputeNavigationTargets']));
    }

    /**
     * Finds the entity set that a navigation property targets.
     *
     * @param INavigationProperty $navigationProperty The navigation property.
     * @return IEntitySet The entity set that the navigation property targets, or null if no such entity set exists.
     */
    public function findNavigationTarget(INavigationProperty $navigationProperty): IEntitySet
    {
        if($this->navigationPropertyMappings->offsetExists($navigationProperty)){
            /** @noinspection PhpIllegalArrayKeyTypeInspection SplObjectStorage can have object array index. */
            return $this->navigationPropertyMappings->offsetGet($navigationProperty);
        }
        return null;
    }

    /**
     * Adds a navigation target, specifying the destination entity set of a navigation property of an entity in this entity set.
     *
     * @param INavigationProperty $property The navigation property the target is being set for.
     * @param IEntitySet $target The destination entity set of the specified navigation property.
     */
    public function AddNavigationTarget(INavigationProperty $property, IEntitySet $target): void
    {
        $this->navigationPropertyMappings->attach($property, $target);
        $this->navigationTargetsCache->Clear();
    }
    /** @noinspection PhpUnusedPrivateMethodInspection Invoked as callable.*/
    /**
     * @return INavigationTargetMapping[]
     */
    private function ComputeNavigationTargets(): array
    {
        $result = [];
        /**
         * @var INavigationProperty $mappingKey
         * @var IEntitySet $mappingValue
         */
        foreach ($this->navigationPropertyMappings as $mappingKey => $mappingValue) {
            $result[] = new EdmNavigationTargetMapping($this->navigationPropertyMappings->current(), $this->navigationPropertyMappings->getInfo());
        }
        return $result;
    }
}
