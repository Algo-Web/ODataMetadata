<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITypeAnnotation;

use AlgoWeb\ODataMetadata\Csdl\Internal\Semantics\BadElements\IUnresolvedElement;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a vocabulary annotations term can be found through the model containing the annotation.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITypeAnnotation
 */
class TypeAnnotationInaccessibleTerm extends TypeAnnotationRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $annotation)
    {
        assert($annotation instanceof ITypeAnnotation);
        $term = $annotation->getTerm();
        if (!($term instanceof IUnresolvedElement) &&
            $context->getModel()->FindType($term->FullName()) instanceof IStructuredType) {
            EdmUtil::checkArgumentNull($annotation->Location(), 'annotation->Location');
            $context->AddError(
                $annotation->Location(),
                EdmErrorCode::BadUnresolvedTerm(),
                StringConst::EdmModel_Validator_Semantic_InaccessibleTerm($term->FullName())
            );
        }
    }
}
