<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 *  Validates that an element namespace is not a reserved system namespace.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement
 */
class SchemaElementSystemNamespaceEncountered extends SchemaElementRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $element)
    {
        assert($element instanceof ISchemaElement);
        if (ValidationHelper::IsEdmSystemNamespace($element->getNamespace())) {
            $context->AddError(
                $element->Location(),
                EdmErrorCode::SystemNamespaceEncountered(),
                StringConst::EdmModel_Validator_Semantic_SystemNamespaceEncountered($element->getNamespace())
            );
        }
    }
}
