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
 * Validates multiplicity of the principal end:
 *  0..1 - if some dependent properties are nullable,
 *     1 - if some dependent properties are not nullable.
 *     * - not allowed.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyPrincipalEndMultiplicity extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $navigationProperty)
    {
        assert($navigationProperty instanceof INavigationProperty);
        /*
                    Dependent properties |       |         |        |
                    nullable?            |  All  |  Mixed  |  None  |
                    -------------------------------------------------
                                    0..1 |   +   |    +    |  error |
                    -------------------------------------------------
                                       1 | error |    +    |    +   |
                    -------------------------------------------------
                                       * | error |  error  |  error |
                    -------------------------------------------------
        */

        $dependentProperties = $navigationProperty->getDependentProperties();
        if ($dependentProperties === null) {
            return;
        }
        if (ValidationHelper::AllPropertiesAreNullable($dependentProperties)) {
            if (!$navigationProperty->getPartner()->Multiplicity()->isZeroOrOne()) {
                $context->AddError(
                    $navigationProperty->getPartner()->Location(),
                    EdmErrorCode::InvalidMultiplicityOfPrincipalEnd(),
                    StringConst::EdmModel_Validator_Semantic_InvalidMultiplicityOfPrincipalEndDependentPropertiesAllNullable($navigationProperty->getPartner()->getName(), $navigationProperty->getName())
                );
            }
        } elseif (!ValidationHelper::HasNullableProperty($dependentProperties)) {
            if (!$navigationProperty->getPartner()->Multiplicity()->isOne()) {
                $context->AddError(
                    $navigationProperty->getPartner()->Location(),
                    EdmErrorCode::InvalidMultiplicityOfPrincipalEnd(),
                    StringConst::EdmModel_Validator_Semantic_InvalidMultiplicityOfPrincipalEndDependentPropertiesAllNonnullable($navigationProperty->getPartner()->getName(), $navigationProperty->getName())
                );
            }
        } else {
            if (!$navigationProperty->getPartner()->Multiplicity()->isOne() &&
                !$navigationProperty->getPartner()->Multiplicity()->isZeroOrOne()) {
                $context->AddError(
                    $navigationProperty->getPartner()->Location(),
                    EdmErrorCode::InvalidMultiplicityOfPrincipalEnd(),
                    StringConst::EdmModel_Validator_Semantic_NavigationPropertyPrincipalEndMultiplicityUpperBoundMustBeOne($navigationProperty->getName())
                );
            }
        }
    }
}
