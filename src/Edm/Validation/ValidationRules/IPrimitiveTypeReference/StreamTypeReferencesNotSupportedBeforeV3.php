<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveTypeReference;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * References to EDM stream type are not supported before version 3.0.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveTypeReference
 */
class StreamTypeReferencesNotSupportedBeforeV3 extends PrimitiveTypeReferenceRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $type)
    {
        assert($type instanceof IPrimitiveTypeReference);
        if ($type->isStream()) {
            EdmUtil::checkArgumentNull($type->Location(), 'type->Location');
            $context->addError(
                $type->Location(),
                EdmErrorCode::StreamTypeReferencesNotSupportedBeforeV3(),
                StringConst::EdmModel_Validator_Semantic_StreamTypeReferencesNotSupportedBeforeV3()
            );
        }
    }
}
