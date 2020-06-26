<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEnumMember;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Helpers\EdmTypeSemantics;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Util\ExpressionTypeChecker;

/**
 * Raises an error if the type of an enum member doesn't match the underlying type of the enum it belongs to.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEnumMember
 */
class EnumMemberValueMustHaveSameTypeAsUnderlyingType extends EnumMemberRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $enumMember)
    {
        assert($enumMember instanceof IEnumMember);
        $discoveredErrors = [];
                   if (
                       !$context->checkIsBad($enumMember->getDeclaringType()) &&
                       !$context->checkIsBad($enumMember->getDeclaringType()->getUnderlyingType()) &&
                       !ExpressionTypeChecker::TryAssertPrimitiveAsType($enumMember->getValue(),
                           EdmTypeSemantics::GetPrimitiveTypeReference($enumMember->getDeclaringType()->getUnderlyingType(), false), $discoveredErrors))
                   {
                       $context->AddError(
                           $enumMember->Location(),
                           EdmErrorCode::EnumMemberTypeMustMatchEnumUnderlyingType(),
                           StringConst::EdmModel_Validator_Semantic_EnumMemberTypeMustMatchEnumUnderlyingType($enumMember->getName()));
                   }    }
}