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
        foreach ($set->getNavigationTargets() as $mapping) {
            if (!(
                $mapping->getTargetEntitySet()->getElementType()->IsOrInheritsFrom(
                    $mapping->getNavigationProperty()->ToEntityType()
                ) ||
                    $mapping->getNavigationProperty()->ToEntityType()->IsOrInheritsFrom(
                        $mapping->getTargetEntitySet()->getElementType()
                    )
            ) &&
                !$context->checkIsBad($mapping->getTargetEntitySet())) {
                EdmUtil::checkArgumentNull($set->Location(), 'set->Location');
                $context->addError(
                    $set->Location(),
                    EdmErrorCode::EntitySetNavigationPropertyMappingMustPointToValidTargetForProperty(),
                    StringConst::EdmModel_Validator_Semantic_EntitySetNavigationPropertyMappingMustPointToValidTargetForProperty($mapping->getNavigationProperty()->getName(), $mapping->getTargetEntitySet()->getName())
                );
            }
        }
    }
}
