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
 * Validates that no part of an entity key is nullable.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType
 */
class EntityTypeInvalidKeyNullablePart extends EntityTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $entityType)
    {
        assert($entityType instanceof IEntityType);
        if ($entityType->Key() != null) {
            foreach ($entityType->Key() as $key) {
                if ($key->getType()->IsPrimitive()) {
                    if ($key->getType()->getNullable()) {
                        EdmUtil::checkArgumentNull($key->Location(), 'key->Location');
                        $context->AddError(
                            $key->Location(),
                            EdmErrorCode::InvalidKey(),
                            StringConst::EdmModel_Validator_Semantic_InvalidKeyNullablePart($key->getName(), $entityType->getName())
                        );
                    }
                }
            }
        }
    }
}
