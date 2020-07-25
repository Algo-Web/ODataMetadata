<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotatable;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Validates that there are no annotations that share the same term and qualifier.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotatable
 */
class VocabularyAnnotatableNoDuplicateAnnotations extends VocabularyAnnotatableRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $annotatable)
    {
        assert($annotatable instanceof IVocabularyAnnotatable);
        $annotationSet = new HashSetInternal();
        foreach ($annotatable->vocabularyAnnotations($context->getModel()) as $annotation) {
            if (!$annotationSet->add($annotation->getTerm()->fullName() . ':' . $annotation->getQualifier())) {
                EdmUtil::checkArgumentNull($annotation->location(), 'annotation->Location');
                $context->addError(
                    $annotation->location(),
                    EdmErrorCode::DuplicateAnnotation(),
                    StringConst::EdmModel_Validator_Semantic_DuplicateAnnotation(
                        EdmUtil::fullyQualifiedName(
                            $annotatable
                        ),
                        $annotation->getTerm()->fullName(),
                        $annotation->getQualifier()
                    )
                );
            }
        }
    }
}
