<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet\EntitySetRule;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Validates that there are not duplicate properties in an entity key.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType
 */
class EntityTypeDuplicatePropertyNameSpecifiedInEntityKey extends EntitySetRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $entityType)
    {
        assert($entityType instanceof IEntityType);
        if ($entityType->getDeclaredKey() != null) {
            $keyPropertyNameList = new HashSetInternal();
            foreach ($entityType->getDeclaredKey() as $item) {
                ValidationHelper::AddMemberNameToHashSet(
                    $item,
                    $keyPropertyNameList,
                    $context,
                    EdmErrorCode::DuplicatePropertySpecifiedInEntityKey(),
                    StringConst::EdmModel_Validator_Semantic_DuplicatePropertyNameSpecifiedInEntityKey($entityType->getName(), $item->getName()),
                    false
                );
            }
        }
    }
}
