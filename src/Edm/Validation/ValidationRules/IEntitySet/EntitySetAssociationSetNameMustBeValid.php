<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\Helpers;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;

/**
 * Validates an association set's name is correct.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet
 */
class EntitySetAssociationSetNameMustBeValid extends EntitySetRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $set)
    {
        assert($set instanceof IEntitySet);
        $mappings = $set->getNavigationTargets();
        foreach ($mappings as $mapping) {
            if ($mapping->getNavigationProperty()->getPrimary() === $mapping->getNavigationProperty()) {
                Helpers::checkForNameError(
                    $context,
                    $context->getModel()->getAssociationSetName(
                        $set,
                        $mapping->getNavigationProperty()
                    ),
                    $set->location()
                );
            }
        }
    }
}
