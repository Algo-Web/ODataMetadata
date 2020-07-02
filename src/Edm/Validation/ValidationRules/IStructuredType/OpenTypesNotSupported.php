<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Open types are supported only in version 1.2 and after version 2.0.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType
 */
class OpenTypesNotSupported extends StructuredTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $structuredType)
    {
        assert($structuredType instanceof IStructuredType);
        if ($structuredType->isOpen()) {
            EdmUtil::checkArgumentNull($structuredType->Location(), 'structuredType->Location');
            $context->AddError(
                $structuredType->Location(),
                EdmErrorCode::OpenTypeNotSupported(),
                StringConst::EdmModel_Validator_Semantic_OpenTypesSupportedOnlyInV12AndAfterV3()
            );
        }
    }
}
