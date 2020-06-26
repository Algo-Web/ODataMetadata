<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
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
        assert( $entityType instanceof IEntityType);
        if (($entityType->Key() == null || count($entityType->Key()) == 0) && $entityType->getBaseType() === null)
        {
            $context->AddError(
                $entityType->Location(),
                EdmErrorCode::KeyMissingOnEntityType(),
                StringConst::EdmModel_Validator_Semantic_KeyMissingOnEntityType($entityType->getName()));
        }
    }
}