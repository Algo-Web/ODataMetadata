<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\Helpers;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;

/**
 * Validates that an association name is valid.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyAssociationNameIsValid extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $property)
    {
        assert($property instanceof INavigationProperty);
        if ($property->isPrincipal()) {
            Helpers::CheckForNameError(
                $context,
                $context->getModel()->GetAssociationName($property),
                $property->Location()
            );
        }
    }
}
