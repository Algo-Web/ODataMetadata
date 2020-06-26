<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRowType;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a row type contains at least one property.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRowType
 */
class RowTypeMustContainProperties extends RowTypeRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $rowType)
    {
        assert($rowType instanceof IRowType);
        if (count($rowType->Properties()) === 0)
        {
            $context->AddError(
                $rowType->Location(),
                EdmErrorCode::RowTypeMustHaveProperties(),
                StringConst::EdmModel_Validator_Semantic_RowTypeMustHaveProperties()
            );
        }
    }
}