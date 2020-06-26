<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that an element namespace is not empty or whitespace.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement
 */
class SchemaElementNamespaceMustNotBeEmptyOrWhiteSpace extends SchemaElementRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $item)
    {
        assert($item instanceof ISchemaElement);
        if (EdmUtil::IsNullOrWhiteSpaceInternal($item->getNamespace()) || strlen($item->getNamespace()) === 0)
        {
            $context->AddError(
                $item->Location(),
                EdmErrorCode::InvalidNamespaceName(),
                StringConst::EdmModel_Validator_Syntactic_MissingNamespaceName());
        }
    }
}