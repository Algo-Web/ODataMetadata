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
 * Validates that the entity type has a key.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType
 */
class EntityTypeKeyMissingOnEntityType extends EntityTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $entityType)
    {
        assert($entityType instanceof IEntityType);
        if ((null === $entityType->key() || count($entityType->key()) == 0) && null === $entityType->getBaseType()) {
            EdmUtil::checkArgumentNull($entityType->location(), 'entityType->Location');
            $context->addError(
                $entityType->location(),
                EdmErrorCode::KeyMissingOnEntityType(),
                StringConst::EdmModel_Validator_Semantic_KeyMissingOnEntityType($entityType->getName())
            );
        }
    }
}
