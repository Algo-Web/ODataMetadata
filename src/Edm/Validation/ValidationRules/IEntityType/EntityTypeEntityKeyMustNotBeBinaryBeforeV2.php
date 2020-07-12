<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
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
        $rawKey = $entityType->Key();
        if (null !== $rawKey) {
            foreach ($rawKey as $key) {
                assert($key instanceof IStructuralProperty);
                if ($key->getType()->IsBinary() && !$context->checkIsBad($key->getType()->getDefinition())) {
                    EdmUtil::checkArgumentNull($key->Location(), 'key->Location');
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
