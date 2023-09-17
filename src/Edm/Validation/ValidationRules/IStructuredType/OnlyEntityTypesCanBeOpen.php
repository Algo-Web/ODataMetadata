<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Open types are supported only on entity types.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType
 */
class OnlyEntityTypesCanBeOpen extends StructuredTypeRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $structuredType)
    {
        assert($structuredType instanceof IStructuredType);
        if ($structuredType->isOpen() && !$structuredType->getTypeKind()->isEntity()) {
            $context->AddError(
                $structuredType->Location(),
                EdmErrorCode::OpenTypeNotSupported(),
                StringConst::EdmModel_Validator_Semantic_OpenTypesSupportedForEntityTypesOnly());
        }
    }
}