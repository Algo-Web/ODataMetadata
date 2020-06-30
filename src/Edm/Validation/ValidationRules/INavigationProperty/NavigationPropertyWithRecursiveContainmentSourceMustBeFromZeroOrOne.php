<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 *  Validates that if a navigation property has IEdmNavigationProperty.ContainsTarget = true and the target entity type
 *  is the same as
 *  the declaring type of the property, then the multiplicity of the source of navigation is Zero-Or-One.
 *  This depends on there being a targeting cycle. Because of the rule EntitySetNavigationMappingMustBeBidirectional,
 *  we know that either this is always true, or there will be an error.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyWithRecursiveContainmentSourceMustBeFromZeroOrOne extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $property)
    {
        assert($property instanceof INavigationProperty);
        if (
            $property->containsTarget() &&
            $property->getDeclaringType()->IsOrInheritsFrom($property->ToEntityType()) &&
            !$property->Multiplicity()->isZeroOrOne()
        ) {
            $context->AddError(
                $property->Location(),
                EdmErrorCode::NavigationPropertyWithRecursiveContainmentSourceMustBeFromZeroOrOne(),
                StringConst::EdmModel_Validator_Semantic_NavigationPropertyWithRecursiveContainmentSourceMustBeFromZeroOrOne($property->getName())
            );
        }
    }
}
