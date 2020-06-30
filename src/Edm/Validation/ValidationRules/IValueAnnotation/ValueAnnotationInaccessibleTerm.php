<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IValueAnnotation;

use AlgoWeb\ODataMetadata\Csdl\Internal\Semantics\BadElements\IUnresolvedElement;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a vocabulary annotations term can be found through the model containing the annotation.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IValueAnnotation
 */
class ValueAnnotationInaccessibleTerm extends ValueAnnotationRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $annotation)
    {
        assert($annotation instanceof IValueAnnotation);
        // An unbound term is not treated as a semantic error, and looking up its name would fail.
        $term = $annotation->getTerm();
        if (!($term instanceof IUnresolvedElement) && $context->getModel()->FindValueTerm($term->FullName()) == null) {
            $context->AddError(
                $annotation->Location(),
                EdmErrorCode::BadUnresolvedTerm(),
                StringConst::EdmModel_Validator_Semantic_InaccessibleTerm($annotation->getTerm()->FullName())
            );
        }
    }
}
