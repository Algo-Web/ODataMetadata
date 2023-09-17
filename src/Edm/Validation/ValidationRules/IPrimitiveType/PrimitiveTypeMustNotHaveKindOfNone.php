<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveType;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * A primitive type without other errors must not have kind of none.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveType
 */
class PrimitiveTypeMustNotHaveKindOfNone extends PrimitiveTypeRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $type)
    {
        assert($type instanceof IPrimitiveType);
        if ($type->getPrimitiveKind()->isNone() && !$context->checkIsBad($type))
        {
            $context->AddError(
                $type->Location(),
                EdmErrorCode::PrimitiveTypeMustNotHaveKindOfNone(),
                StringConst::EdmModel_Validator_Semantic_PrimitiveTypeMustNotHaveKindOfNone($type->FullName()));
        }
    }

}