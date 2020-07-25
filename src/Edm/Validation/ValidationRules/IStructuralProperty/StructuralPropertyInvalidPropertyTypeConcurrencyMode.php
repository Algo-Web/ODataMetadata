<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuralProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
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
        /* @var IStructuralProperty $property */
        assert($property instanceof IStructuralProperty);

        $propType = $property->getType();
        EdmUtil::checkArgumentNull($propType, 'property->getType');
        $def      = $propType->getDefinition();
        EdmUtil::checkArgumentNull($def, 'property->getType->getDefinition');
        $loc      = $propType->location();
        EdmUtil::checkArgumentNull($loc, 'property->Location');

        $key      = strval($propType->typeKind()->getKey());
        if ($property->getConcurrencyMode()->isFixed() &&
            !$propType->isPrimitive() &&
            !$context->checkIsBad($def)) {
            $context->addError(
                $loc,
                EdmErrorCode::InvalidPropertyType(),
                StringConst::EdmModel_Validator_Semantic_InvalidPropertyTypeConcurrencyMode(
                    (
                        $propType->isCollection() ?
                        EdmConstants::Type_Collection :
                        $key
                    )
                )
            );
        }
    }
}
