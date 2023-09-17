<?php

declare(strict_types=1);

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
        if (EdmUtil::isNullOrWhiteSpaceInternal($item->getNamespace()) || mb_strlen($item->getNamespace()) === 0) {
            EdmUtil::checkArgumentNull($item->location(), 'item->Location');
            $context->addError(
                $item->location(),
                EdmErrorCode::InvalidNamespaceName(),
                StringConst::EdmModel_Validator_Syntactic_MissingNamespaceName()
            );
        }
    }
}
