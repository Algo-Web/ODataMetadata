<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDirectValueAnnotation;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStringValue;

/**
 * Validates that an immediate value annotation that is flagged to be serialized as an element can be serialized safely.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDirectValueAnnotation
 */
class ImmediateValueAnnotationElementAnnotationHasNameAndNamespace extends DirectValueAnnotationRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $annotation)
    {
        assert($annotation instanceof IDirectValueAnnotation);
        $stringValue = $annotation->getValue();
        if ($stringValue != null && $stringValue instanceof IStringValue) {
            if (boolval(
                $context
                    ->getModel()
                    ->getDirectValueAnnotationsManager()
                    ->getAnnotationValue(
                        $stringValue,
                        EdmConstants::InternalUri,
                        CsdlConstants::IsSerializedAsElementAnnotation
                    ) ?? false
            )) {
                $error = null;
                if (!
                ValidationHelper::ValidateValueCanBeWrittenAsXmlElementAnnotation(
                    $stringValue,
                    $annotation->getNamespaceUri(),
                    $annotation->getName(),
                    $error
                )
                ) {
                    $context->AddRawError($error);
                }
            }
        }
    }
}
