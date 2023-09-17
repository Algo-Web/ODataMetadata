<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet\EntitySetRule;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that all parts of an entity key are scalar.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType
 */
class EntityTypeEntityKeyMustBeScalar extends EntitySetRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $entityType)
    {
        assert($entityType instanceof IEntityType);
        if ($entityType->Key() != null)
        {
            foreach ($entityType->Key() as $key)
            {
                assert($key instanceof IStructuralProperty);
                if (!$key->getType()->IsPrimitive() && !$context->checkIsBad($key))
                {
                    $context->AddError(
                        $key->Location(),
                        EdmErrorCode::EntityKeyMustBeScalar(),
                        StringConst::EdmModel_Validator_Semantic_EntityKeyMustBeScalar($key->getName(), $entityType->getName()));
                }
            }
        }
    }
}