<?php


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;


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
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

trait ProcessExpressions
{

    protected function ProcessExpression(IExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->endElement($expression, __METHOD__);

    }

    protected function ProcessStringConstantExpression(IStringConstantExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessBinaryConstantExpression(IBinaryConstantExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessRecordExpression(IRecordExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        if ($expression->getDeclaredType() != null) {
            $this->VisitTypeReference($expression->getDeclaredType());
        }

        $this->VisitPropertyConstructors($expression->getProperties());
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessPropertyReferenceExpression(IPropertyReferenceExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        if ($expression->getBase() != null) {
            $this->VisitExpression($expression->getBase());
        }
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessPathExpression(IPathExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessParameterReferenceExpression(IParameterReferenceExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessCollectionExpression(ICollectionExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->VisitExpressions($expression->getElements());
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessLabeledExpressionReferenceExpression(ILabeledExpressionReferenceExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessIsTypeExpression(IIsTypeExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->VisitTypeReference($expression->getType());
        $this->VisitExpression($expression->getOperand());
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessIntegerConstantExpression(IIntegerConstantExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessIfExpression(IIfExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->VisitExpression($expression->getTestExpression());
        $this->VisitExpression($expression->getTrueExpression());
        $this->VisitExpression($expression->getFalseExpression());
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessFunctionReferenceExpression(IFunctionReferenceExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessFunctionApplicationExpression(IApplyExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->VisitExpression($expression->getAppliedFunction());
        $this->VisitExpressions($expression->getArguments());
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessFloatingConstantExpression(IFloatingConstantExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessGuidConstantExpression(IGuidConstantExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessEnumMemberReferenceExpression(IEnumMemberReferenceExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessEntitySetReferenceExpression(IEntitySetReferenceExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessDecimalConstantExpression(IDecimalConstantExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessDateTimeConstantExpression(IDateTimeConstantExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessDateTimeOffsetConstantExpression(IDateTimeOffsetConstantExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessTimeConstantExpression(ITimeConstantExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessBooleanConstantExpression(IBooleanConstantExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessAssertTypeExpression(IAssertTypeExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->VisitTypeReference($expression->getType());
        $this->VisitExpression($expression->getOperand());
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessLabeledExpression(ILabeledExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->VisitExpression($expression->getExpression());
        $this->endElement($expression, __METHOD__);
    }

    protected function ProcessPropertyConstructor(IPropertyConstructor $constructor): void
    {
        $this->startElement($constructor, __METHOD__);
        $this->VisitExpression($constructor->getValue());
        $this->endElement($constructor, __METHOD__);
    }

    protected function ProcessNullConstantExpression(INullExpression $expression): void
    {
        $this->startElement($expression, __METHOD__);
        $this->ProcessExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    abstract function VisitExpression(IExpression $getValue): void;

    abstract function VisitTypeReference(ITypeReference $getType): void;

    abstract function VisitExpressions(array $getArguments): void;

    abstract function VisitPropertyConstructors(array $getProperties): void;
}