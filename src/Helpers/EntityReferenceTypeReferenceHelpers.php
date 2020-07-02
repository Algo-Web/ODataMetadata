<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Trait EntityReferenceTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait EntityReferenceTypeReferenceHelpers
{
    /**
     * Gets the definition of this entity reference type reference.
     *
     * @return IEntityReferenceType the definition of this entity reference type reference
     */
    public function EntityReferenceDefinition(): IEntityReferenceType
    {
        /**
         * @var IEntityReferenceTypeReference $this;
         */
        $definition = $this->getDefinition();
        assert($definition instanceof IEntityReferenceType, 'IEntityReferenceTypeReference should always wrap a defined IEntityReferenceType');
        return $definition;
    }

    /**
     * Gets the entity type referred to by the definition of this entity reference type reference.
     *
     * @return IEntityType the entity type referred to by the definition of this entity reference type reference
     */
    public function EntityType(): IEntityType
    {
        return $this->EntityReferenceDefinition()->getEntityType();
    }

    abstract public function getDefinition(): ?IType;
}
