<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Validates that no navigation property is mapped to two different entity sets.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet
 */
class EntitySetNavigationPropertyMappingsMustBeUnique extends EntitySetRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $set)
    {
        assert($set instanceof IEntitySet);
        $mappedPropertySet = new HashSetInternal();
        foreach ($set->getNavigationTargets() as $mapping) {
            if ($mappedPropertySet->add($mapping->getNavigationProperty())) {
                EdmUtil::checkArgumentNull($set->location(), 'set->Location');
                $context->addError(
                    $set->location(),
                    EdmErrorCode::DuplicateNavigationPropertyMapping(),
                    StringConst::EdmModel_Validator_Semantic_DuplicateNavigationPropertyMapping($set->getContainer()->fullName() . '.' . $set->getName(), $mapping->getNavigationProperty()->getName())
                );
            }
        }
    }
}
