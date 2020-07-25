<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuralProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that any property with a complex type is not nullable.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuralProperty
 */
class StructuralPropertyNullableComplexType extends StructuralPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $property)
    {
        assert($property instanceof IStructuralProperty);
        if ($property->getType()->isComplex() && $property->getType()->getNullable()) {
            EdmUtil::checkArgumentNull($property->Location(), 'property->Location');
            $context->AddError(
                $property->Location(),
                EdmErrorCode::NullableComplexTypeProperty(),
                StringConst::EdmModel_Validator_Semantic_NullableComplexTypeProperty($property->getName())
            );
        }
    }
}
