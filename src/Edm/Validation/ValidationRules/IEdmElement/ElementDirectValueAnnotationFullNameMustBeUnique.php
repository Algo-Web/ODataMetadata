<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEdmElement;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
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
        EdmUtil::checkArgumentNull($item, 'item');
        $annotationNameSet = [];
        foreach ($context->getModel()->getDirectValueAnnotationsManager()->getDirectValueAnnotations($item) as $annotation) {
            assert($annotation instanceof IDirectValueAnnotation);
            EdmUtil::checkArgumentNull($annotation->location(), 'annotation->Location');
            if (in_array($annotation->getNamespaceUri() . ':' . $annotation->getName(), $annotationNameSet)) {
                EdmUtil::checkArgumentNull($annotation->location(), 'annotation->Location');
                $context->addError(
                    $annotation->location(),
                    EdmErrorCode::DuplicateDirectValueAnnotationFullName(),
                    StringConst::EdmModel_Validator_Semantic_ElementDirectValueAnnotationFullNameMustBeUnique($annotation->getNamespaceUri(), $annotation->getName())
                );
            } else {
                $annotationNameSet[] = $annotation->getNamespaceUri() . ':' . $annotation->getName();
            }
        }
    }
}
