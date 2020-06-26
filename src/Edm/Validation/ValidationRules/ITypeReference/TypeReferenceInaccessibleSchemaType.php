<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITypeReference;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\Helpers;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Validates that a type reference refers to a type that can be found through the model being validated.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITypeReference
 */
class TypeReferenceInaccessibleSchemaType extends TypeReferenceRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $typeReference)
    {
        assert($typeReference instanceof ITypeReference);
        $schemaType = $typeReference->getDefinition();
        if ($schemaType !== null && $schemaType instanceof ISchemaType && !$context->checkIsBad($schemaType))
        {
            Helpers::CheckForUnreachableTypeError($context, $schemaType, $typeReference->Location());
        }
    }
}