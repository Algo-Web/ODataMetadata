<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that the navigation property does not have both a multiplicity of many and an OnDelete operation.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyEndWithManyMultiplicityCannotHaveOperationsSpecified extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $end)
    {
        assert($end instanceof INavigationProperty);
        // If an end has a multiplicity of many, it cannot have any operation behaviour
        if (
            $end->Multiplicity()->isMany() &&
            !$end->getOnDelete()->isNone()
        )
        {
            $context->AddError(
                $end->Location(),
                EdmErrorCode::EndWithManyMultiplicityCannotHaveOperationsSpecified(),
                StringConst::EdmModel_Validator_Semantic_EndWithManyMultiplicityCannotHaveOperationsSpecified($end->getName())
            );
        }
    }
}