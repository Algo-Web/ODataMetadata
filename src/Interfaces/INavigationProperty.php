<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Enums\OnDeleteAction;
use AlgoWeb\ODataMetadata\Helpers\NavigationPropertyHelpers;

/**
 * Interface IEdmNavigationProperty
 *
 * Represents an EDM navigation property.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 * @mixin NavigationPropertyHelpers
 */
interface INavigationProperty extends IProperty
{
    /**
     * @return INavigationProperty Gets the partner of this navigation property.
     */
    public function getPartner(): INavigationProperty;

    /**
     * @return OnDeleteAction Gets the action to execute on the deletion of this end of a bidirectional association.
     */
    public function getOnDelete(): OnDeleteAction;

    /**
     * @return bool Gets whether this navigation property originates at the principal end of an association.
     */
    public function isPrincipal(): bool;

    /**
     * @return IStructuralProperty[]|null Gets the dependent properties of this navigation property, returning null if
     *                                    this is the principal end or if there is no referential constraint.
     */
    public function getDependentProperties(): ?array;

    /**
     * @return bool Gets a value indicating whether the navigation target is contained inside the navigation source.
     */
    public function containsTarget(): bool;


}