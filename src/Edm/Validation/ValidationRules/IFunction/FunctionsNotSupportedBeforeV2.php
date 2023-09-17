<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunction;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Raises an error if a function is found.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunction
 */
class FunctionsNotSupportedBeforeV2 extends FunctionRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $function)
    {
        assert($function instanceof IFunction);
        EdmUtil::checkArgumentNull($function->location(), 'function->Location');
        $context->addError(
            $function->location(),
            EdmErrorCode::FunctionsNotSupportedBeforeV2(),
            StringConst::EdmModel_Validator_Semantic_FunctionsNotSupportedBeforeV2()
        );
    }
}
