<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPropertyValueBinding;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Util\ExpressionTypeChecker;

/**
 * Validates that the value of a property value binding is the correct type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPropertyValueBinding
 */
class PropertyValueBindingValueIsCorrectType extends PropertyValueBindingRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $binding)
    {
        assert($binding instanceof IPropertyValueBinding);
        $errors = null;
        if (!ExpressionTypeChecker::tryAssertType(
            $binding->getValue(),
            $binding->getBoundProperty()->getType(),
            $errors
        ) &&
            !$context->checkIsBad($binding) &&
            !$context->checkIsBad($binding->getBoundProperty())
        ) {
            foreach ($errors as $error) {
                $context->AddRawError($error);
            }
        }
    }
}
