<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that if a navigation property mapping is of recursive containment, the mapping points back to the source
 * entity set.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet
 */
class EntitySetRecursiveNavigationPropertyMappingsMustPointBackToSourceEntitySet extends EntitySetRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $set)
    {
        assert($set instanceof IEntitySet);
        foreach ($set->getNavigationTargets() as $mapping)
        {
            if (
                $mapping->getNavigationProperty()->containsTarget() &&
                $mapping->getNavigationProperty()->getDeclaringType()->IsOrInheritsFrom($mapping->getNavigationProperty()->ToEntityType()) &&
                $mapping->getTargetEntitySet() !== $set)
            {
                $context->AddError(
                    $set->Location(),
                    EdmErrorCode::EntitySetRecursiveNavigationPropertyMappingsMustPointBackToSourceEntitySet(),
                    StringConst::EdmModel_Validator_Semantic_EntitySetRecursiveNavigationPropertyMappingsMustPointBackToSourceEntitySet($mapping->getNavigationProperty(), $set->getName()));
            }
        }
    }
}