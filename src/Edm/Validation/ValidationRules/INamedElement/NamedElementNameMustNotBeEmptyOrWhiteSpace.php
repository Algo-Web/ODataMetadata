<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INamedElement;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a name is not empty or whitespace.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEdmNamedElement
 */
class NamedElementNameMustNotBeEmptyOrWhiteSpace extends NamedElementRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $item)
    {
        assert($item instanceof INamedElement);
        if (EdmUtil::isNullOrWhiteSpaceInternal($item->getName()) || mb_strlen($item->getName()) === 0) {
            EdmUtil::checkArgumentNull($item->Location(), 'item->Location');
            $context->AddError(
                $item->Location(),
                EdmErrorCode::InvalidName(),
                StringConst::EdmModel_Validator_Syntactic_MissingName()
            );
        }
    }
}
