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
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Validates that if an entity does not directly contain itself, it cannot contain itself through a containment loop.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyEntityMustNotIndirectlyContainItself extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $property)
    {
        assert($property instanceof INavigationProperty);
        if ($property->containsTarget() &&
            !$property->getDeclaringType()->isOrInheritsFrom($property->toEntityType())) {
            if (ValidationHelper::typeIndirectlyContainsTarget(
                $property->toEntityType(),
                $property->declaringEntityType(),
                /*new SplObjectStorage()*/
                new HashSetInternal(),
                $context->getModel()
            )) {
                EdmUtil::checkArgumentNull($property->location(), 'property->Location');
                $context->addError(
                    $property->location(),
                    EdmErrorCode::NavigationPropertyEntityMustNotIndirectlyContainItself(),
                    StringConst::EdmModel_Validator_Semantic_NavigationPropertyEntityMustNotIndirectlyContainItself(
                        $property->getName()
                    )
                );
            }
        }
    }
}
