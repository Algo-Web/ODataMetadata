<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that only one end of an association has an OnDelete operation.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyInvalidOperationMultipleEndsInAssociation extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $navigationProperty)
    {
        assert($navigationProperty instanceof INavigationProperty);
        if (!$navigationProperty->getOnDelete()->isNone() &&
            !$navigationProperty->getPartner()->getOnDelete()->isNone()) {
            EdmUtil::checkArgumentNull($navigationProperty->Location(), 'navigationProperty->Location');
            $context->addError(
                $navigationProperty->Location(),
                EdmErrorCode::InvalidAction(),
                StringConst::EdmModel_Validator_Semantic_InvalidOperationMultipleEndsInAssociation()
            );
        }
    }
}
