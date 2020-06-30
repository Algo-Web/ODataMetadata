<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuralProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that if the concurrency mode of a property is fixed, the type is primitive.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuralProperty
 */
class StructuralPropertyInvalidPropertyTypeConcurrencyMode extends StructuralPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $property)
    {
        assert($property instanceof IStructuralProperty);
        if ($property->getConcurrencyMode()->isFixed() &&
            !$property->getType()->IsPrimitive() &&
            !$context->checkIsBad($property->getType()->getDefinition())) {
            $context->AddError(
                $property->Location(),
                EdmErrorCode::InvalidPropertyType(),
                StringConst::EdmModel_Validator_Semantic_InvalidPropertyTypeConcurrencyMode(
                    (
                        $property->getType()->IsCollection() ?
                        EdmConstants::Type_Collection :
                        $property->getType()->TypeKind()->getKey()
                    )
                )
            );
        }
    }
}
