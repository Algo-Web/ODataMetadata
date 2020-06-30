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
 * Validates that no part of an entity key is a binary primitive type.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType
 */
class EntityTypeEntityKeyMustNotBeBinaryBeforeV2 extends EntityTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $entityType)
    {
        assert($entityType instanceof IEntityType);
        if ($entityType->Key() != null) {
            foreach ($entityType->Key() as $key) {
                assert($key instanceof IStructuralProperty);
                if ($key->getType()->IsBinary() && !$context->checkIsBad($key->getType()->getDefinition())) {
                    $context->AddError(
                        $key->Location(),
                        EdmErrorCode::EntityKeyMustNotBeBinary(),
                        StringConst::EdmModel_Validator_Semantic_EntityKeyMustNotBeBinaryBeforeV2($key->getName(), $entityType->getName())
                    );
                }
            }
        }
    }
}
