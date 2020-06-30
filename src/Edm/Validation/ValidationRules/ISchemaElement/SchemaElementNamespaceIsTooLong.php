<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that an element namespace is not too long according to the CSDL spec.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement
 */
class SchemaElementNamespaceIsTooLong extends SchemaElementRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $item)
    {
        assert($item instanceof ISchemaElement);
        if (strlen($item->getNamespace()) > CsdlConstants::Max_NamespaceLength) {
            $context->AddError(
                $item->Location(),
                EdmErrorCode::InvalidNamespaceName(),
                StringConst::EdmModel_Validator_Syntactic_EdmModel_NamespaceNameIsTooLong($item->getNamespace())
            );
        }
    }
}
