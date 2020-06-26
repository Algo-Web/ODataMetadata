<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDirectValueAnnotation;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStringValue;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that an immediate value annotation has a name and a namespace.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDirectValueAnnotation
 */
class ImmediateValueAnnotationElementAnnotationIsValid extends DirectValueAnnotationRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $annotation)
    {
        assert($annotation instanceof IDirectValueAnnotation);
        $stringValue = $annotation->getValue();
                    if ($stringValue != null && $stringValue instanceof IStringValue)
                    {
                        if (
                            boolval(
                                $context
                                    ->getModel()
                                    ->getDirectValueAnnotationsManager()
                                    ->getAnnotationValue(
                                        $stringValue,
                                        EdmConstants::InternalUri,
                                        CsdlConstants::IsSerializedAsElementAnnotation
                                    ) ?? false
                            )
                        )
                        {
                            if (
                                EdmUtil::IsNullOrWhiteSpaceInternal($annotation->getNamespaceUri()) ||
                                EdmUtil::IsNullOrWhiteSpaceInternal($annotation->getName())
                            )
                            {
                                $context->AddError(
                                    $annotation->Location(),
                                    EdmErrorCode::InvalidElementAnnotation(),
                                    StringConst::EdmModel_Validator_Semantic_InvalidElementAnnotationMismatchedTerm());
                            }
                        }
                    }    }
}