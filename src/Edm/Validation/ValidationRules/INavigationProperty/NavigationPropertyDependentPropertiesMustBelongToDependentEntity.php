<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
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
        if (null !== $dependentProperties) {
            $dependentEntity = $navigationProperty->declaringEntityType();
            $dependentProperties = array_filter(
                $dependentProperties,
                function ($prop) use ($context) {
                    return !$context->checkIsBad($prop);
                }
            );
            foreach ($dependentProperties as $dependantProperty) {
                assert($dependantProperty instanceof IStructuralProperty);
                $property = $dependentEntity->findProperty($dependantProperty->getName());
                // If we can't find the property by name, or we find a good property but it's not our
                // dependent property
                if ($property !== $dependantProperty) {
                    EdmUtil::checkArgumentNull($navigationProperty->location(), 'navigationProperty->Location');
                    $context->addError(
                        $navigationProperty->location(),
                        EdmErrorCode::DependentPropertiesMustBelongToDependentEntity(),
                        StringConst::EdmModel_Validator_Semantic_DependentPropertiesMustBelongToDependentEntity(
                            $dependantProperty->getName(),
                            $dependentEntity->getName()
                        )
                    );
                }
            }
        }
    }
}
