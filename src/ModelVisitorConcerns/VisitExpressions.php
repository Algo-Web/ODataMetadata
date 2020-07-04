<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
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
use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Trait VisitExpressions.
 * @package AlgoWeb\ODataMetadata\ModelVisitorConcerns
 * @mixin EdmModelVisitor
 */
trait VisitExpressions
{
    public function VisitExpressions(array $expressions): void
    {
        /** @var EdmModelVisitor $this */
        self::VisitCollection($expressions, [$this, 'VisitExpression']);
    }

    public function VisitExpression(IExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        switch ($expression->getExpressionKind()) {
            case ExpressionKind::AssertType():
                assert($expression instanceof  IAssertTypeExpression);
                $this->processAssertTypeExpression($expression);
                break;
            case ExpressionKind::BinaryConstant():
                assert($expression instanceof  IBinaryConstantExpression);
                $this->processBinaryConstantExpression($expression);
                break;
            case ExpressionKind::BooleanConstant():
                assert($expression instanceof  IBooleanConstantExpression);
                $this->processBooleanConstantExpression($expression);
                break;
            case ExpressionKind::Collection():
                assert($expression instanceof  ICollectionExpression);
                $this->processCollectionExpression($expression);
                break;
            case ExpressionKind::DateTimeConstant():
                assert($expression instanceof  IDateTimeConstantExpression);
                $this->processDateTimeConstantExpression($expression);
                break;
            case ExpressionKind::DateTimeOffsetConstant():
                assert($expression instanceof  IDateTimeOffsetConstantExpression);
                $this->processDateTimeOffsetConstantExpression($expression);
                break;
            case ExpressionKind::DecimalConstant():
                assert($expression instanceof  IDecimalConstantExpression);
                $this->processDecimalConstantExpression($expression);
                break;
            case ExpressionKind::EntitySetReference():
                assert($expression instanceof  IEntitySetReferenceExpression);
                $this->processEntitySetReferenceExpression($expression);
                break;
            case ExpressionKind::EnumMemberReference():
                assert($expression instanceof  IEnumMemberReferenceExpression);
                $this->processEnumMemberReferenceExpression($expression);
                break;
            case ExpressionKind::FloatingConstant():
                assert($expression instanceof  IFloatingConstantExpression);
                $this->processFloatingConstantExpression($expression);
                break;
            case ExpressionKind::FunctionApplication():
                assert($expression instanceof  IApplyExpression);
                $this->processFunctionApplicationExpression($expression);
                break;
            case ExpressionKind::FunctionReference():
                assert($expression instanceof  IFunctionReferenceExpression);
                $this->processFunctionReferenceExpression($expression);
                break;
            case ExpressionKind::GuidConstant():
                assert($expression instanceof  IGuidConstantExpression);
                $this->processGuidConstantExpression($expression);
                break;
            case ExpressionKind::If():
                assert($expression instanceof  IIfExpression);
                $this->processIfExpression($expression);
                break;
            case ExpressionKind::IntegerConstant():
                assert($expression instanceof  IIntegerConstantExpression);
                $this->processIntegerConstantExpression($expression);
                break;
            case ExpressionKind::IsType():
                assert($expression instanceof  IIsTypeExpression);
                $this->processIsTypeExpression($expression);
                break;
            case ExpressionKind::ParameterReference():
                assert($expression instanceof  IParameterReferenceExpression);
                $this->processParameterReferenceExpression($expression);
                break;
            case ExpressionKind::LabeledExpressionReference():
                assert($expression instanceof  ILabeledExpressionReferenceExpression);
                $this->processLabeledExpressionReferenceExpression($expression);
                break;
            case ExpressionKind::Labeled():
                assert($expression instanceof  ILabeledExpression);
                $this->processLabeledExpression($expression);
                break;
            case ExpressionKind::Null():
                assert($expression instanceof  INullExpression);
                $this->processNullConstantExpression($expression);
                break;
            case ExpressionKind::Path():
                assert($expression instanceof  IPathExpression);
                $this->processPathExpression($expression);
                break;
            case ExpressionKind::PropertyReference():
                assert($expression instanceof  IPropertyReferenceExpression);
                $this->processPropertyReferenceExpression($expression);
                break;
            case ExpressionKind::Record():
                assert($expression instanceof  IRecordExpression);
                $this->processRecordExpression($expression);
                break;
            case ExpressionKind::StringConstant():
                assert($expression instanceof  IStringConstantExpression);
                $this->processStringConstantExpression($expression);
                break;
            case ExpressionKind::TimeConstant():
                assert($expression instanceof  ITimeConstantExpression);
                $this->processTimeConstantExpression($expression);
                break;
            case ExpressionKind::ValueTermReference():
                assert($expression instanceof  IPropertyReferenceExpression);
                $this->processPropertyReferenceExpression($expression);
                break;
            case ExpressionKind::None():
                $this->processExpression($expression);
                break;
            default:
                throw new InvalidOperationException(
                    StringConst::UnknownEnumVal_TermKind($expression->getExpressionKind()->getKey())
                );
        }
    }
    /**
     * @param IPropertyConstructor[] $constructor
     */
    public function visitPropertyConstructors(array $constructor): void
    {
        /** @var EdmModelVisitor $this */
        self::VisitCollection($constructor, [$this, 'processPropertyConstructor']);
    }
}
