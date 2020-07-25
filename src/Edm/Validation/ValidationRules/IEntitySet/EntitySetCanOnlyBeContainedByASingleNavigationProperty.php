<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that an entity set can only have a single navigation property targeting it that has Contains set to true.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet
 */
class EntitySetCanOnlyBeContainedByASingleNavigationProperty extends EntitySetRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $set)
    {
        assert($set instanceof IEntitySet);
        $containmentFound = false;
        foreach ($set->getContainer()->EntitySets() as $otherSet) {
            foreach ($otherSet->getNavigationTargets() as $mapping) {
                $property = $mapping->getNavigationProperty();

                if ($mapping->getTargetEntitySet() === $set && $property->containsTarget()) {
                    if ($containmentFound) {
                        EdmUtil::checkArgumentNull($set->Location(), 'set->Location');
                        $context->addError(
                            $set->Location(),
                            EdmErrorCode::EntitySetCanOnlyBeContainedByASingleNavigationProperty(),
                            StringConst::EdmModel_Validator_Semantic_EntitySetCanOnlyBeContainedByASingleNavigationProperty($set->getContainer()->FullName() . '.' . $set->getName())
                        );
                    }

                    $containmentFound = true;
                }
            }
        }
    }
}
