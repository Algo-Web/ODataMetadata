<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\INavigationTargetMapping;

/**
 * Represents a mapping from an EDM navigation property to an entity set.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmNavigationTargetMapping implements INavigationTargetMapping
{
    /**
     * @var INavigationProperty
     */
private  $navigationProperty;
    /**
     * @var IEntitySet
     */
private  $targetEntitySet;

    /**
     * Creates a new navigation target mapping.
     *
     * @param INavigationProperty $navigationProperty The navigation property.
     * @param IEntitySet $targetEntitySet The entity set that the navigation propertion targets.
     */
    public function __construct(INavigationProperty $navigationProperty, IEntitySet $targetEntitySet)
    {
        $this->navigationProperty = $navigationProperty;
        $this->targetEntitySet = $targetEntitySet;
    }

    /**
     * @return INavigationProperty Gets the navigation property.
     */
    public function getNavigationProperty(): INavigationProperty
    {
        return $this->navigationProperty;
    }

    /**
     * @return IEntitySet Gets the target entity set.
     */
    public function getTargetEntitySet(): IEntitySet
    {
        return $this->targetEntitySet;
    }
}