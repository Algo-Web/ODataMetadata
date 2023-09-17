<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEdmElement;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that no direct value annotations share the same name and namespace.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEdmElement
 */
class ElementDirectValueAnnotationFullNameMustBeUnique extends EdmElementRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $item)
    {
        $annotationNameSet = [];
        foreach ($context->getModel()->getDirectValueAnnotationsManager()->getDirectValueAnnotations($item) as $annotation) {
            assert($annotation instanceof IDirectValueAnnotation);
            if (in_array($annotation->getNamespaceUri() . ':' . $annotation->getName(), $annotationNameSet)) {
                $context->AddError(
                    $annotation->Location(),
                    EdmErrorCode::DuplicateDirectValueAnnotationFullName(),
                    StringConst::EdmModel_Validator_Semantic_ElementDirectValueAnnotationFullNameMustBeUnique($annotation->getNamespaceUri(), $annotation->getName())
                );
            } else {
                $annotationNameSet[] = $annotation->getNamespaceUri() . ':' . $annotation->getName();
            }
        }
    }
}
