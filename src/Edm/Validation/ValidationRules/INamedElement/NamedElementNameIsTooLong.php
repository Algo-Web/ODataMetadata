<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INamedElement;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that an element name is not too long according to the CSDL spec.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEdmNamedElement
 */
class NamedElementNameIsTooLong extends NamedElementRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $item)
    {
        assert($item instanceof INamedElement);
        if (!EdmUtil::IsNullOrWhiteSpaceInternal($item->getName()) && mb_strlen($item->getName()) > CsdlConstants::Max_NameLength) {
            EdmUtil::checkArgumentNull($item->Location(), 'item->Location');
            $context->AddError(
                $item->Location(),
                EdmErrorCode::NameTooLong(),
                StringConst::EdmModel_Validator_Syntactic_EdmModel_NameIsTooLong($item->getName())
            );
        }
    }
}
