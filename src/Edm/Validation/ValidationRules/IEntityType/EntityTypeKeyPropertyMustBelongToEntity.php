<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that all properties in the key of an entity belong to that entity.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType
 */
class EntityTypeKeyPropertyMustBelongToEntity extends EntityTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $entityType)
    {
        assert($entityType instanceof IEntityType);
        if ($entityType->getDeclaredKey() != null) {
            foreach ($entityType->getDeclaredKey() as $key) {
                assert($key instanceof IStructuralProperty);
                // Key must be one of the declared properties.
                if ($key->getDeclaringType() !== $entityType && !$context->checkIsBad($key)) {
                    $context->AddError(
                        $entityType->Location(),
                        EdmErrorCode::KeyPropertyMustBelongToEntity(),
                        StringConst::EdmModel_Validator_Semantic_KeyPropertyMustBelongToEntity($key->getName(), $entityType->getName())
                    );
                }
            }
        }
    }
}
