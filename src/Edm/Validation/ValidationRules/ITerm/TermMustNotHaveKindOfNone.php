<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITerm;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * A term without other errors must not have kind of none.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITerm
 */
class TermMustNotHaveKindOfNone extends TermRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $term)
    {
        assert($term instanceof ITerm);
        if ($term->getTermKind()->isNone() && !$context->checkIsBad($term)) {
            EdmUtil::checkArgumentNull($term->location(), 'term->Location');
            $context->addError(
                $term->location(),
                EdmErrorCode::TermMustNotHaveKindOfNone(),
                StringConst::EdmModel_Validator_Semantic_TermMustNotHaveKindOfNone($term->fullName())
            );
        }
    }
}
