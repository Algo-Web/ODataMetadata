<?php


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;

/**
 * Trait EntityReferenceTypeReferenceHelpers
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait EntityReferenceTypeReferenceHelpers
{
    /**
     * Gets the definition of this entity reference type reference.
     *
     * @return IEntityReferenceType The definition of this entity reference type reference.
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
     * @return IEntityType The entity type referred to by the definition of this entity reference type reference.
     */
    public function EntityType(): IEntityType
    {

        return $this->EntityReferenceDefinition()->getEntityType();
    }
}