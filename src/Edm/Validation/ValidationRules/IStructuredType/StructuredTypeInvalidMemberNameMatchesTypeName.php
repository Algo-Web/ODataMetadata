<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a type does not have a property with the same name as that type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType
 */
class StructuredTypeInvalidMemberNameMatchesTypeName extends StructuredTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $structuredType)
    {
        assert($structuredType instanceof IStructuredType);
        $schemaType = $structuredType;
        assert($schemaType instanceof ISchemaType);
        $schemaName = $schemaType->getName();

        $properties = iterable_to_array($structuredType->properties());
        $properties = array_filter(
            $properties,
            function ($property) use ($schemaName) {
                return null !== $property && $property->getName() === $schemaName;
            }
        );
        foreach ($properties as $property) {
            assert($property instanceof IProperty);
            EdmUtil::checkArgumentNull($structuredType->location(), 'structuredType->Location');
            EdmUtil::checkArgumentNull($property->location(), 'property->Location');
            $context->addError(
                $property->location(),
                EdmErrorCode::BadProperty(),
                StringConst::EdmModel_Validator_Semantic_InvalidMemberNameMatchesTypeName(
                    $property->getName()
                )
            );
        }
    }
}
