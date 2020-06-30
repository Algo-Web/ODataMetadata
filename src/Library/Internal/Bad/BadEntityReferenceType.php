<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;

/**
 * Represents a semantically invalid EDM entity reference type.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadEntityReferenceType extends BadType implements IEntityReferenceType
{
    /**
     * @var IEntityType
     */
    private $entityType;

    public function __construct(array $errors)
    {
        parent::__construct($errors);
        $this->entityType = new BadEntityType('', $this->getErrors());
    }

    /**
     * @return IEntityType|null gets the entity type pointed to by this entity reference
     */
    public function getEntityType(): ?IEntityType
    {
        return $this->entityType;
    }

    public function getTypeKind(): TypeKind
    {
        return TypeKind::EntityReference();
    }
}
