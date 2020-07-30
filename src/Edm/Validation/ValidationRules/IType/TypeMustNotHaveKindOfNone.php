<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * A type without other errors must not have kind of none.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IType
 */
class TypeMustNotHaveKindOfNone extends TypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $type)
    {
        assert($type instanceof IType);
        if ($type->getTypeKind()->isNone() && !$context->checkIsBad($type)) {
            EdmUtil::checkArgumentNull($type->location(), 'type->Location');
            $context->addError(
                $type->location(),
                EdmErrorCode::TypeMustNotHaveKindOfNone(),
                StringConst::EdmModel_Validator_Semantic_TypeMustNotHaveKindOfNone()
            );
        }
    }
}
