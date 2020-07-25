<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionBase;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Validates that a function does not have multiple parameters with the same name.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionBase
 */
class FunctionBaseParameterNameAlreadyDefinedDuplicate extends FunctionBaseRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $edmFunction)
    {
        assert($edmFunction instanceof IFunctionBase);
        $parameterList = new HashSetInternal();
        if (null !== $edmFunction->getParameters()) {
            foreach ($edmFunction->getParameters() as $parameter) {
                ValidationHelper::addMemberNameToHashSet(
                    $parameter,
                    $parameterList,
                    $context,
                    EdmErrorCode::AlreadyDefined(),
                    StringConst::EdmModel_Validator_Semantic_ParameterNameAlreadyDefinedDuplicate($parameter->getName()),
                    false
                );
            }
        }
    }
}
