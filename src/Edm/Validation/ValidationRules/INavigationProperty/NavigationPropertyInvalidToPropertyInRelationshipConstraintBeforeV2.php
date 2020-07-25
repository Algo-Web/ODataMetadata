<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that all dependent properties are a subset of the dependent entity types key.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyInvalidToPropertyInRelationshipConstraintBeforeV2 extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $navigationProperty)
    {
        assert($navigationProperty instanceof INavigationProperty);
        $dependentProperties = $navigationProperty->getDependentProperties();
        if (null !== $dependentProperties) {
            EdmUtil::checkArgumentNull(
                $navigationProperty->declaringEntityType()->key(),
                'navigationProperty->DeclaringEntityType->Key'
            );
            if (!ValidationHelper::propertySetIsSubset(
                $navigationProperty->declaringEntityType()->key(),
                $dependentProperties
            )) {
                EdmUtil::checkArgumentNull($navigationProperty->location(), 'navigationProperty->Location');
                $context->addError(
                    $navigationProperty->location(),
                    EdmErrorCode::InvalidPropertyInRelationshipConstraint(),
                    StringConst::EdmModel_Validator_Semantic_InvalidToPropertyInRelationshipConstraint(
                        $navigationProperty->getName(),
                        $navigationProperty->declaringEntityType()->fullName()
                    )
                );
            }
        }
    }
}
