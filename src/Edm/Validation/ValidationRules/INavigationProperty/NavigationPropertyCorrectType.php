<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that the type of a navigation property corresponds to the other end of the association and the
 * multiplicity of the other end.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyCorrectType extends NavigationPropertyRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $property)
    {
        assert($property instanceof INavigationProperty);
        $isBad = false;

        if ($property->ToEntityType() !== $property->getPartner()->DeclaringEntityType()) {
            $isBad = true;
        } else {
            switch ($property->getPartner()->Multiplicity()) {
                case Multiplicity::Many():
                    if (!$property->getType()->IsCollection()) {
                        $isBad = true;
                    }

                    break;
                case Multiplicity::ZeroOrOne():
                    if ($property->getType()->IsCollection() || !$property->getType()->getNullable()) {
                        $isBad = true;
                    }

                    break;
                case Multiplicity::One():
                    if ($property->getType()->IsCollection() || $property->getType()->getNullable()) {
                        $isBad = true;
                    }

                    break;
            }
        }

        if ($isBad) {
            EdmUtil::checkArgumentNull($property->Location(), 'property->Location');
            $context->AddError(
                $property->Location(),
                EdmErrorCode::InvalidNavigationPropertyType(),
                StringConst::EdmModel_Validator_Semantic_InvalidNavigationPropertyType($property->getName())
            );
        }
    }
}
