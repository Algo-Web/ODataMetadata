<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Helpers\EdmElementComparer;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Library\Internal\Ambiguous\AmbiguousTypeBinding;
use AlgoWeb\ODataMetadata\StringConst;

abstract class Helpers
{
    public static function checkForUnreachableTypeError(ValidationContext $context, ISchemaType $type, ILocation $location): void
    {
        $foundType = $context->getModel()->findType($type->fullName());
        if ($foundType instanceof AmbiguousTypeBinding) {
            $context->addError(
                $location,
                EdmErrorCode::BadAmbiguousElementBinding(),
                StringConst::EdmModel_Validator_Semantic_AmbiguousType($type->fullName())
            );
        } elseif (!EdmElementComparer::isEquivalentTo($foundType, $type)) {
            $context->addError(
                $location,
                EdmErrorCode::BadUnresolvedType(),
                StringConst::EdmModel_Validator_Semantic_InaccessibleType($type->fullName())
            );
        }
    }

    public static function checkForNameError(ValidationContext $context, string $name, ILocation $location): void
    {
        if (EdmUtil::isNullOrWhiteSpaceInternal($name) || mb_strlen($name) === 0) {
            $context->addError(
                $location,
                EdmErrorCode::InvalidName(),
                StringConst::EdmModel_Validator_Syntactic_MissingName()
            );
        } elseif (mb_strlen($name) > CsdlConstants::Max_NameLength) {
            $context->addError(
                $location,
                EdmErrorCode::NameTooLong(),
                StringConst::EdmModel_Validator_Syntactic_EdmModel_NameIsTooLong($name)
            );
        } elseif (!EdmUtil::isValidUndottedName($name)) {
            $context->addError(
                $location,
                EdmErrorCode::InvalidName(),
                StringConst::EdmModel_Validator_Syntactic_EdmModel_NameIsNotAllowed($name)
            );
        }
    }
}
