<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRowType;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a row type does not have a base type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRowType
 */
class RowTypeBaseTypeMustBeNull extends RowTypeRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $rowType)
    {
        assert($rowType instanceof IRowType);
        if ($rowType->getBaseType() != null)
        {
            $context->AddError(
                $rowType->Location(),
                EdmErrorCode::RowTypeMustNotHaveBaseType(),
                StringConst::EdmModel_Validator_Semantic_RowTypeMustNotHaveBaseType()
            );
        }
    }
}