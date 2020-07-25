<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\Helpers;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;

/**
 * Validates that an association end name is valid.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyAssociationEndNameIsValid extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $property)
    {
        assert($property instanceof INavigationProperty);
        Helpers::checkForNameError(
            $context,
            $context->getModel()->getAssociationEndName($property),
            $property->location()
        );
    }
}
