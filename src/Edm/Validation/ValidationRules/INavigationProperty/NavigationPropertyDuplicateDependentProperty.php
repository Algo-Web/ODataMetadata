<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Validates that the dependent properties of a navigation property contain no duplicates.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyDuplicateDependentProperty extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $navigationProperty)
    {
        assert($navigationProperty instanceof INavigationProperty);
        $dependentProperties = $navigationProperty->getDependentProperties();
        if (null !== $dependentProperties) {
            $propertyNames = new HashSetInternal();
            $dependentProperties = array_filter(
                $dependentProperties,
                function ($property) {
                    return null !== $property;
                }
            );
            foreach ($dependentProperties as $property) {
                ValidationHelper::addMemberNameToHashSet(
                    $property,
                    $propertyNames,
                    $context,
                    EdmErrorCode::DuplicateDependentProperty(),
                    StringConst::EdmModel_Validator_Semantic_DuplicateDependentProperty(
                        $property->getName(),
                        $navigationProperty->getName()
                    ),
                    false
                );
            }
        }
    }
}
