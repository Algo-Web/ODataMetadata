<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * A schema element without other errors must not have kind of none.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement
 */
class SchemaElementMustNotHaveKindOfNone extends SchemaElementRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $element)
    {
        assert($element instanceof ISchemaElement);
        if ($element->getSchemaElementKind()->isNone() && !$context->checkIsBad($element))
        {
            $context->AddError(
                $element->Location(),
                EdmErrorCode::SchemaElementMustNotHaveKindOfNone(),
                StringConst::EdmModel_Validator_Semantic_SchemaElementMustNotHaveKindOfNone($element->FullName()));
        }
    }
}