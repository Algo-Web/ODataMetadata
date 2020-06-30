<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;

/**
 * Trait NavigationPropertyHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface INavigationPropertyHelpers
{
    /**
     * Gets the multiplicity of this end of a bidirectional relationship between this navigation property and its partner.
     *
     * @return Multiplicity the multiplicity of this end of the relationship
     */
    public function Multiplicity(): Multiplicity;

    /**
     * Gets the entity type targeted by this navigation property.
     *
     * @return IEntityType the entity type targeted by this navigation property
     */
    public function ToEntityType(): IEntityType;

    /**
     * Gets the entity type declaring this navigation property.
     *
     * @return IEntityType the entity type that declares this navigation property
     */
    public function DeclaringEntityType(): IEntityType;

    public function PopulateCaches(): void;

    /**
     * Gets the primary end of a pair of partnered navigation properties, selecting the principal end if there is one and making a stable, arbitrary choice otherwise.
     *
     * @return INavigationProperty the primary end between the navigation property and its partner
     */
    public function GetPrimary(): INavigationProperty;
}