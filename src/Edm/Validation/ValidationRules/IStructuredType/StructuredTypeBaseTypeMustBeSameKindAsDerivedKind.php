<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that the base type of a complex type is complex, and the base type of an entity type is an entity.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType
 */
class StructuredTypeBaseTypeMustBeSameKindAsDerivedKind extends StructuredTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $structuredType)
    {
        assert($structuredType instanceof IStructuredType);
        // We can either have 2 rules (entity and complex) or have one rule and exclude row type. I'm choosing
        // the latter.
        if ($structuredType instanceof ISchemaType) {
            if ($structuredType->getBaseType() != null &&
                $structuredType->getBaseType()->getTypeKind() !== $structuredType->getTypeKind()
            ) {
                EdmUtil::checkArgumentNull($structuredType->Location(), 'structuredType->Location');
                $context->AddError(
                    $structuredType->Location(),
                    (
                        $structuredType->getTypeKind()->isEntity() ?
                        EdmErrorCode::EntityMustHaveEntityBaseType()
                        :
                        EdmErrorCode::ComplexTypeMustHaveComplexBaseType()
                    ),
                    StringConst::EdmModel_Validator_Semantic_BaseTypeMustHaveSameTypeKind()
                );
            }
        }
    }
}
