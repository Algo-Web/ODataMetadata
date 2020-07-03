<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Validates that there are not duplicate properties in a type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType
 */
class StructuredTypePropertyNameAlreadyDefined extends StructuredTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $structuredType)
    {
        assert($structuredType instanceof IStructuredType);
        $propertyNames = new HashSetInternal();
        foreach ($structuredType->Properties() as $property) {
            // We only want to report the properties that are declared in this type. Otherwise properties will get
            // reported multiple times due to inheritance.
            if ($property != null) {
                ValidationHelper::AddMemberNameToHashSet(
                    $property,
                    $propertyNames,
                    $context,
                    EdmErrorCode::AlreadyDefined(),
                    StringConst::EdmModel_Validator_Semantic_PropertyNameAlreadyDefined($property->getName()),
                    !in_array($property, $structuredType->getDeclaredProperties())
                );
            }
        }
    }
}
