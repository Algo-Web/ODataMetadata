<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * A property without other errors must not have kind of none.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IProperty
 */
class PropertyMustNotHaveKindOfNone extends PropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $property)
    {
        assert($property instanceof IProperty);
        if ($property->getPropertyKind()->isNone() && !$context->checkIsBad($property)) {
            $context->AddError(
                $property->Location(),
                EdmErrorCode::PropertyMustNotHaveKindOfNone(),
                StringConst::EdmModel_Validator_Semantic_PropertyMustNotHaveKindOfNone($property->getName())
            );
        }
    }
}
