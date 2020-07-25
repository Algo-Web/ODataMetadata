<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRowType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
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
        if (count($rowType->properties()) === 0) {
            EdmUtil::checkArgumentNull($rowType->location(), 'rowType->Location');
            $context->addError(
                $rowType->location(),
                EdmErrorCode::RowTypeMustHaveProperties(),
                StringConst::EdmModel_Validator_Semantic_RowTypeMustHaveProperties()
            );
        }
    }
}
