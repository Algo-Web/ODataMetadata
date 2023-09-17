<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;

/**
 * Class EdmEntityReferenceType.
 *
 *  Represents a definition of an EDM entity reference type.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmEntityReferenceType extends EdmType implements IEntityReferenceType
{
    /**
     * @var IEntityType
     */
    private $entityType;

    /**
     * Initializes a new instance of the EdmEntityReferenceType class.
     *
     * @param IEntityType $entityType the entity referred to by this entity reference
     */
    public function __construct(IEntityType $entityType)
    {
        $this->entityType = $entityType;
    }

    /**
     * @return IEntityType|null gets the entity type pointed to by this entity reference
     */
    public function getEntityType(): ?IEntityType
    {
        return $this->entityType;
    }

    /**
     * @return TypeKind gets the kind of this type
     */
    public function getTypeKind(): TypeKind
    {
        return TypeKind::EntityReference();
    }
}
