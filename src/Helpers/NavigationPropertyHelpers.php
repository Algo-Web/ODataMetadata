<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;

/**
 * Trait NavigationPropertyHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait NavigationPropertyHelpers
{
    /**
     * Gets the multiplicity of this end of a bidirectional relationship between this navigation property and its partner.
     *
     * @return Multiplicity the multiplicity of this end of the relationship
     */
    public function Multiplicity(): Multiplicity
    {
        /**
         * @var INavigationProperty $this ;
         */
        $partner = $this->getPartner();
        if ($partner !== null) {
            $partnerType = $partner->getType();
            if ($partnerType->IsCollection()) {
                return Multiplicity::Many();
            }
            return $partnerType->getNullable() ? Multiplicity::ZeroOrOne() : Multiplicity::One();
        }
        return Multiplicity::One();
    }

    /**
     * Gets the entity type targeted by this navigation property.
     *
     * @return IEntityType the entity type targeted by this navigation property
     */
    public function ToEntityType(): IEntityType
    {
        /**
         * @var INavigationProperty $this;
         */
        $target = $this->getType()->getDefinition();
        if ($target->getTypeKind()->isCollection()) {
            assert($target instanceof ICollectionType);
            $target = $target->getElementType()->getDefinition();
        }

        if ($target->getTypeKind()->isEntityReference()) {
            assert($target instanceof IEntityReferenceType);
            $target = $target->getEntityType();
        }
        assert($target instanceof IEntityType, 'The final target of any navitation property should be a Entity.');
        return $target;
    }

    /**
     * Gets the entity type declaring this navigation property.
     *
     * @return IEntityType the entity type that declares this navigation property
     */
    public function DeclaringEntityType(): IEntityType
    {
        /**
         * @var INavigationProperty $this;
         */
        $declaringType = $this->getDeclaringType();
        assert($declaringType instanceof IEntityType, 'navigation prperties should always be delcared on a Entity');
        return $declaringType;
    }
    public function PopulateCaches(): void
    {
        /**
         * @var INavigationProperty $property;
         */
        $property = $this;
        // Force computation that can apply annotations to the navigation property.
        $property->getPartner();
        $property->isPrincipal();
        $property->getDependentProperties();
    }

    /**
     * Gets the primary end of a pair of partnered navigation properties, selecting the principal end if there is one and making a stable, arbitrary choice otherwise.
     *
     * @return INavigationProperty the primary end between the navigation property and its partner
     */
    public function GetPrimary(): INavigationProperty
    {
        /**
         * @var INavigationProperty $property;
         */
        $property = $this;
        if ($property->isPrincipal()) {
            return $property;
        }

        $partner = $property->getPartner();
        if ($partner->isPrincipal()) {
            return $partner;
        }

        // There is no meaningful basis for determining which of the two partners is principal,
        // so break the tie with an arbitrary, stable comparision.
        $nameComparison = strcmp($property->getName(), $partner->getName());
        if ($nameComparison == 0) {
            $nameComparison = strcmp($property->DeclaringEntityType()->FullName(), $partner->DeclaringEntityType()->FullName());
        }

        return $nameComparison > 0 ? $property : $partner;
    }
}
