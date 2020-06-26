<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityContainerElement;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * An entity container element without other errors must not have kind of none.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityContainerElement
 */
class EntityContainerElementMustNotHaveKindOfNone extends EntityContainerRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $element)
    {
        assert($element instanceof IEntityContainerElement);
        if ($element->getContainerElementKind()->isNone() && !$context->checkIsBad($element))
        {
            $context->AddError(
                $element->Location(),
                EdmErrorCode::EntityContainerElementMustNotHaveKindOfNone(),
                StringConst::EdmModel_Validator_Semantic_EntityContainerElementMustNotHaveKindOfNone($element->getContainer()->FullName() . '/' . $element->getName()));
        }
    }

}