<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Helpers\EdmElementComparer;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that each pair of properties between the dependent properties and the principal ends key are of the same
 * type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyTypeMismatchRelationshipConstraint extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $navigationProperty)
    {
        assert($navigationProperty instanceof INavigationProperty);
        $dependentProperties = $navigationProperty->getDependentProperties();
        if ($dependentProperties != null) {
            $dependentPropertiesCount = count($dependentProperties);
            $principalEntityType      = $navigationProperty->getPartner()->declaringEntityType();
            $principalKey             = $principalEntityType->key();
            $location                 = $navigationProperty->location();
            EdmUtil::checkArgumentNull($location, 'navigationProperty->Location');
            if ($dependentPropertiesCount == count($principalKey)) {
                for ($i = 0; $i < $dependentPropertiesCount; $i++) {
                    $depProp = $navigationProperty->getDependentProperties()[$i];

                    if (!EdmElementComparer::isEquivalentTo(
                        $depProp->getType()->getDefinition(),
                        $principalKey[$i]->getType()->getDefinition()
                    )) {
                        $errorMessage = StringConst::EdmModel_Validator_Semantic_TypeMismatchRelationshipConstraint(
                            $depProp->getName(),
                            $navigationProperty->declaringEntityType()->fullName(),
                            $principalKey[$i]->getName(),
                            $principalEntityType->getName(),
                            'Dingus'
                        );

                        $context->addError(
                            $location,
                            EdmErrorCode::TypeMismatchRelationshipConstraint(),
                            $errorMessage
                        );
                    }
                }
            }
        }
    }
}
