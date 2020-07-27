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
        $entitySets = $set->getContainer()->entitySets();
        foreach ($entitySets as $otherSet) {
            $mappings = $otherSet->getNavigationTargets();
            foreach ($mappings as $mapping) {
                $property = $mapping->getNavigationProperty();

                if ($mapping->getTargetEntitySet() === $set && $property->containsTarget()) {
                    if ($containmentFound) {
                        EdmUtil::checkArgumentNull($set->location(), 'set->Location');
                        $context->addError(
                            $set->location(),
                            EdmErrorCode::EntitySetCanOnlyBeContainedByASingleNavigationProperty(),
                            StringConst::EdmModel_Validator_Semantic_EntitySetCanOnlyBeContainedByASingleNavigationProperty($set->getContainer()->fullName() . '.' . $set->getName())
                        );
                    }

                    $containmentFound = true;
                }
            }
        }
    }
}
