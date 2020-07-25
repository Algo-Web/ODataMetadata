<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that the declaring type of a property contains that property.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType
 */
class StructuredTypePropertiesDeclaringTypeMustBeCorrect extends StructuredTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $structuredType)
    {
        assert($structuredType instanceof IStructuredType);
        foreach ($structuredType->getDeclaredProperties() as $property) {
            if ($property != null) {
                if ($property->getDeclaringType() !== $structuredType) {
                    EdmUtil::checkArgumentNull($property->location(), 'property->Location');
                    $context->addError(
                        $property->location(),
                        EdmErrorCode::DeclaringTypeMustBeCorrect(),
                        StringConst::EdmModel_Validator_Semantic_DeclaringTypeMustBeCorrect($property->getName())
                    );
                }
            }
        }
    }
}
