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
        EdmUtil::checkArgumentNull($item->getNamespace(), 'item->getNamespace');
        // max length is hard coded in the xsd
        if (mb_strlen($item->getNamespace()) <= CsdlConstants::Max_NamespaceLength &&
            mb_strlen($item->getNamespace()) > 0 &&
            !EdmUtil::isNullOrWhiteSpaceInternal($item->getNamespace())
        ) {
            if (!EdmUtil::isValidDottedName($item->getNamespace())) {
                EdmUtil::checkArgumentNull($item->location(), 'item->Location');
                $context->addError(
                    $item->location(),
                    EdmErrorCode::InvalidNamespaceName(),
                    StringConst::EdmModel_Validator_Syntactic_EdmModel_NamespaceNameIsNotAllowed($item->getNamespace())
                );
            }
        }
    }
}
