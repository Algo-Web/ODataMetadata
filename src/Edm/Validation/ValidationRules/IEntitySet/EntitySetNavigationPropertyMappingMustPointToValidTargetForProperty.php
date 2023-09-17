<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that the target of a navigation property mapping is valid for the target type of the property.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet
 */
class EntitySetNavigationPropertyMappingMustPointToValidTargetForProperty extends EntitySetRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $set)
    {
        assert($set instanceof IEntitySet);
        $mappings = $set->getNavigationTargets();
        foreach ($mappings as $mapping) {
            if (!(
                $mapping->getTargetEntitySet()->getElementType()->isOrInheritsFrom(
                    $mapping->getNavigationProperty()->toEntityType()
                ) ||
                    $mapping->getNavigationProperty()->toEntityType()->isOrInheritsFrom(
                        $mapping->getTargetEntitySet()->getElementType()
                    )
            ) &&
                !$context->checkIsBad($mapping->getTargetEntitySet())) {
                EdmUtil::checkArgumentNull($set->location(), 'set->Location');
                $context->addError(
                    $set->location(),
                    EdmErrorCode::EntitySetNavigationPropertyMappingMustPointToValidTargetForProperty(),
                    StringConst::EdmModel_Validator_Semantic_EntitySetNavigationPropertyMappingMustPointToValidTargetForProperty($mapping->getNavigationProperty()->getName(), $mapping->getTargetEntitySet()->getName())
                );
            }
        }
    }
}
