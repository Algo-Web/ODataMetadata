<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that if the dependent properties are equivalent to the key of the dependent end, the multiplicity of the dependent end cannot be 1
 *  Validates multiplicity of the dependent end according to the following rules:
 *  0..1, 1 - if dependent properties represent the dependent end key.
 *        * - if dependent properties don't represent the dependent end key.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyDependentEndMultiplicity extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $navigationProperty)
    {
        assert($navigationProperty instanceof INavigationProperty);
        $dependentProperties = $navigationProperty->getDependentProperties();
        if ($dependentProperties != null) {
            if (ValidationHelper::PropertySetsAreEquivalent($navigationProperty->DeclaringEntityType()->Key(), $dependentProperties)) {
                if (
                    !$navigationProperty->Multiplicity()->isZeroOrOne() &&
                    !$navigationProperty->Multiplicity()->isOne()
                ) {
                    $context->AddError(
                        $navigationProperty->Location(),
                        EdmErrorCode::InvalidMultiplicityOfDependentEnd(),
                        StringConst::EdmModel_Validator_Semantic_InvalidMultiplicityOfDependentEndMustBeZeroOneOrOne($navigationProperty->getName())
                    );
                }
            } elseif ($navigationProperty->Multiplicity()->isMany()) {
                $context->AddError(
                    $navigationProperty->Location(),
                    EdmErrorCode::InvalidMultiplicityOfDependentEnd(),
                    StringConst::EdmModel_Validator_Semantic_InvalidMultiplicityOfDependentEndMustBeMany($navigationProperty->getName())
                );
            }
        }
    }
}
