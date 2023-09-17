<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotation;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Vocabulary annotations are not supported before EDM 3.0.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotation
 */
class VocabularyAnnotationsNotSupportedBeforeV3 extends VocabularyAnnotationRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $vocabularyAnnotation)
    {
        assert($vocabularyAnnotation instanceof IVocabularyAnnotation);
        EdmUtil::checkArgumentNull($vocabularyAnnotation->location(), 'vocabularyAnnotation->Location');
        $context->addError(
            $vocabularyAnnotation->location(),
            EdmErrorCode::VocabularyAnnotationsNotSupportedBeforeV3(),
            StringConst::EdmModel_Validator_Semantic_VocabularyAnnotationsNotSupportedBeforeV3()
        );
    }
}
