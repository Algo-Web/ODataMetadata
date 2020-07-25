<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that if a navigation property has INavigationProperty.ContainsTarget = true and the target entity type is
 * different than the declaring type of the property, then the multiplicity of the source of navigation is One.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyWithNonRecursiveContainmentSourceMustBeFromOne extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $property)
    {
        assert($property instanceof INavigationProperty);
        if ($property->containsTarget() &&
            !$property->getDeclaringType()->isOrInheritsFrom($property->toEntityType()) &&
            !$property->multiplicity()->isOne()) {
            EdmUtil::checkArgumentNull($property->location(), 'property->Location');
            $context->addError(
                $property->location(),
                EdmErrorCode::NavigationPropertyWithNonRecursiveContainmentSourceMustBeFromOne(),
                StringConst::EdmModel_Validator_Semantic_NavigationPropertyWithNonRecursiveContainmentSourceMustBeFromOne($property->getName())
            );
        }
    }
}
