<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\Helpers;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;

/**
 * Validates an association set's name is correct
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet
 */
class EntitySetAssociationSetNameMustBeValid extends EntitySetRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $set)
    {
        assert($set instanceof IEntitySet);
        foreach ($set->getNavigationTargets() as $mapping)
        {
            if ($mapping->getNavigationProperty()->GetPrimary() === $mapping->getNavigationProperty())
            {
                Helpers::CheckForNameError(
                    $context,
                    $context->getModel()->GetAssociationSetName(
                        $set,
                        $mapping->getNavigationProperty()
                    ),
                    $set->Location()
                );
            }
        }
    }
}