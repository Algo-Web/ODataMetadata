<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that all dependent properties of a navigation property belong to the dependent entity type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyDependentPropertiesMustBelongToDependentEntity extends NavigationPropertyRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $navigationProperty)
    {
        assert($navigationProperty instanceof INavigationProperty);
        $dependentProperties = $navigationProperty->getDependentProperties();
        if ($dependentProperties != null) {
            $dependentEntity = $navigationProperty->DeclaringEntityType();
            foreach ($dependentProperties as $dependantProperty) {
                assert($dependantProperty instanceof IStructuralProperty);
                if (!$context->checkIsBad($dependantProperty)) {
                    $property = $dependentEntity->findProperty($dependantProperty->getName());
                    // If we can't find the property by name, or we find a good property but it's not our dependent property
                    if ($property !== $dependantProperty) {
                        $context->AddError(
                            $navigationProperty->Location(),
                            EdmErrorCode::DependentPropertiesMustBelongToDependentEntity(),
                            StringConst::EdmModel_Validator_Semantic_DependentPropertiesMustBelongToDependentEntity($dependantProperty->getName(), $dependentEntity->getName()));
                    }
                }
            }
        }
    }
}