<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IApplyExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IAssertTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBinaryConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBooleanConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ICollectionExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeOffsetConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDecimalConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEntitySetReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEnumMemberReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFloatingConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFunctionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IGuidConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIntegerConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIsTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpressionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IParameterReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPropertyReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IStringConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ITimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IValueTermReferenceExpression;

class VisitorOfIExpression extends VisitorOfT
{

    protected function VisitT($expression, array &$followup, array &$references): iterable
    {
        assert($expression instanceof IExpression);
// Trying to reduce amount of noise in errors - if this expression is bad, then most likely it will have an unacceptable kind, no need to report it.
        $expressionKindError = null;
        if (!InterfaceValidator::IsCheckableBad($expression))
        {
            switch ($expression->getExpressionKind())
            {
                case ExpressionKind::IntegerConstant():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IIntegerConstantExpression::class);
                    break;

                case ExpressionKind::StringConstant():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IStringConstantExpression::class);
                    break;

                case ExpressionKind::BinaryConstant():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IBinaryConstantExpression::class);
                    break;

                case ExpressionKind::BooleanConstant():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IBooleanConstantExpression::class);
                    break;

                case ExpressionKind::DateTimeConstant():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IDateTimeConstantExpression::class);
                    break;

                case ExpressionKind::DateTimeOffsetConstant():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IDateTimeOffsetConstantExpression::class);
                    break;

                case ExpressionKind::TimeConstant():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", ITimeConstantExpression::class);
                    break;

                case ExpressionKind::DecimalConstant():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IDecimalConstantExpression::class);
                    break;

                case ExpressionKind::FloatingConstant():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IFloatingConstantExpression::class);
                    break;

                case ExpressionKind::GuidConstant():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IGuidConstantExpression::class);
                    break;

                case ExpressionKind::Null():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", INullExpression::class);
                    break;

                case ExpressionKind::Record():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IRecordExpression::class);
                    break;

                case ExpressionKind::Collection():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", ICollectionExpression::class);
                    break;

                case ExpressionKind::Path():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IPathExpression::class);
                    break;

                case ExpressionKind::ParameterReference():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IParameterReferenceExpression::class);
                    break;

                case ExpressionKind::FunctionReference():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IFunctionReferenceExpression::class);
                    break;

                case ExpressionKind::PropertyReference():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IPropertyReferenceExpression::class);
                    break;

                case ExpressionKind::ValueTermReference():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IValueTermReferenceExpression::class);
                    break;

                case ExpressionKind::EntitySetReference():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IEntitySetReferenceExpression::class);
                    break;

                case ExpressionKind::EnumMemberReference():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IEnumMemberReferenceExpression::class);
                    break;

                case ExpressionKind::If():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IIfExpression::class);
                    break;

                case ExpressionKind::AssertType():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind",IAssertTypeExpression::class);
                    break;

                case ExpressionKind::IsType():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IIsTypeExpression::class);
                    break;

                case ExpressionKind::FunctionApplication():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", IApplyExpression::class);
                    break;

                case ExpressionKind::Labeled():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", ILabeledExpression::class);
                    break;

                case ExpressionKind::LabeledExpressionReference():
                    $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($expression, $expression->getExpressionKind(), "ExpressionKind", ILabeledExpressionReferenceExpression::class);
                    break;

                default:
                    $expressionKindError = InterfaceValidator::CreateInterfaceKindValueUnexpectedError($expression, $expression->getExpressionKind(), "ExpressionKind");
                    break;
            }
        }

        return $expressionKindError != null ? [ $expressionKindError ] : null;
    }

    public function forType(): string
    {
        return IExpression::class;
    }
}