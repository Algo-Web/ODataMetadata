<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a key is not defined if there is already a key in the base type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType
 */
class EntityTypeInvalidKeyKeyDefinedInBaseClass extends EntityTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $entityType)
    {
        assert($entityType instanceof IEntityType);
        if (null !== $entityType->getBaseType() &&
            null !== $entityType->getDeclaredKey() &&
            $entityType->getBaseType()->getTypeKind()->isEntity() &&
            null !== $entityType->baseEntityType()->getDeclaredKey()) {
            EdmUtil::checkArgumentNull($entityType->location(), 'entityType->Location');
            $context->addError(
                $entityType->location(),
                EdmErrorCode::InvalidKey(),
                StringConst::EdmModel_Validator_Semantic_InvalidKeyKeyDefinedInBaseClass($entityType->getName(), $entityType->baseEntityType()->getName())
            );
        }
    }
}
