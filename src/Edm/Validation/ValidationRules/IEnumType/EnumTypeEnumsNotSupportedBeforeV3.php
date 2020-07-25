<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEnumType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Raises an error if an enum type is found.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\EnumType
 */
class EnumTypeEnumsNotSupportedBeforeV3 extends EnumTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $enumType)
    {
        assert($enumType instanceof IEnumType);
        EdmUtil::checkArgumentNull($enumType->Location(), 'enumType->Location');
        $context->addError(
            $enumType->Location(),
            EdmErrorCode::EnumsNotSupportedBeforeV3(),
            StringConst::EdmModel_Validator_Semantic_EnumsNotSupportedBeforeV3()
        );
    }
}
