<?php


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
    public static function CheckForUnreachableTypeError(ValidationContext $context, ISchemaType $type, ILocation $location): void
    {
        $foundType = $context->getModel()->FindType($type->FullName());
        if ($foundType instanceof AmbiguousTypeBinding) {
            $context->AddError(
                $location,
                EdmErrorCode::BadAmbiguousElementBinding(),
                StringConst::EdmModel_Validator_Semantic_AmbiguousType($type->FullName()));
        } else if (!EdmElementComparer::isEquivalentTo($foundType, $type)) {
            $context->AddError(
                $location,
                EdmErrorCode::BadUnresolvedType(),
                StringConst::EdmModel_Validator_Semantic_InaccessibleType($type->FullName()));
        }
    }

    public static function CheckForNameError(ValidationContext $context, string $name, ILocation $location): void
    {
        if (EdmUtil::IsNullOrWhiteSpaceInternal($name) || strlen($name) === 0) {
            $context->AddError(
                $location,
                EdmErrorCode::InvalidName(),
                StringConst::EdmModel_Validator_Syntactic_MissingName());
        } else if (strlen($name) > CsdlConstants::Max_NameLength) {
            $context->AddError(
                $location,
                EdmErrorCode::NameTooLong(),
                StringConst::EdmModel_Validator_Syntactic_EdmModel_NameIsTooLong($name));
        } else if (!EdmUtil::IsValidUndottedName($name)) {
            $context->AddError(
                $location,
                EdmErrorCode::InvalidName(),
                StringConst::EdmModel_Validator_Syntactic_EdmModel_NameIsNotAllowed($name));
        }
    }
}