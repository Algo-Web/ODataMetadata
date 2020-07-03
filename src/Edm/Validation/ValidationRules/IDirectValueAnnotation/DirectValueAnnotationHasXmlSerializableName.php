<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDirectValueAnnotation;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\Values\IValue;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Util\XmlConvert;

/**
 * Validates that the name of a direct value annotation can safely be serialized as XML.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDirectValueAnnotation
 */
class DirectValueAnnotationHasXmlSerializableName extends DirectValueAnnotationRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $annotation)
    {
        assert($annotation instanceof IDirectValueAnnotation);
        $name = $annotation->getName();

        // We check for null, whitespace, and length in separate IEdmNamedElement validation rules.
        if (!EdmUtil::IsNullOrWhiteSpaceInternal($name) &&
            mb_strlen($name) <= CsdlConstants::Max_NameLength &&
            mb_strlen($name) > 0
        ) {
            // Note: this check can be done without the try/catch block, but we need XmlConvert.IsStartNCNameChar and XmlConvert.IsNCNameChar, which are not available in 3.5.
            if (!XmlConvert::VerifyNCName($annotation->getName())) {
                $value         = $annotation->getValue() ;
                $errorLocation = ($value === null || !($value instanceof IValue)) ? null : $value->Location();
                $context->AddRawError(new EdmError($errorLocation, EdmErrorCode::InvalidName(), StringConst::EdmModel_Validator_Syntactic_EdmModel_NameIsNotAllowed($annotation->getName())));
            }
        }
    }
}
