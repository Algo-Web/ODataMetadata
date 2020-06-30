<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that an element namespace matches the allowed pattern of namespaces according to the CSDL spec.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement
 */
class SchemaElementNamespaceIsNotAllowed extends SchemaElementRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $item)
    {
        assert($item instanceof ISchemaElement);
        // max length is hard coded in the xsd
        if (
            strlen($item->getNamespace()) <= CsdlConstants::Max_NamespaceLength &&
            strlen($item->getNamespace()) > 0 &&
            !EdmUtil::IsNullOrWhiteSpaceInternal($item->getNamespace())
        ) {
            if (!EdmUtil::IsValidDottedName($item->getNamespace())) {
                $context->AddError(
                    $item->Location(),
                    EdmErrorCode::InvalidNamespaceName(),
                    StringConst::EdmModel_Validator_Syntactic_EdmModel_NamespaceNameIsNotAllowed($item->getNamespace())
                );
            }
        }
    }
}
