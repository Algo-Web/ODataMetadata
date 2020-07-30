<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Enums\TermKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Helpers\EntityTypeHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;

class BadEntityType extends BadNamedStructuredType implements IEntityType
{
    use EntityTypeHelpers;

    public function __construct(?string $qualifiedName, array $errors)
    {
        parent::__construct($qualifiedName, $errors);
    }

    /**
     * @return array|IStructuralProperty[] gets the structural properties of the entity type that make up the entity key
     */
    public function getDeclaredKey(): ?array
    {
        return null;
    }

    public function getTypeKind(): TypeKind
    {
        return TypeKind::Entity();
    }

    /**
     * Gets the kind of a term.
     *
     * @return TermKind
     */
    public function getTermKind(): TermKind
    {
        return TermKind::Type();
    }
}
