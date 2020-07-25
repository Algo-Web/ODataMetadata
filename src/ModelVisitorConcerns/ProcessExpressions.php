<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\EdmUtil;
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
    protected function processExpression(IExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->endElement($expression, __METHOD__);
    }

    protected function processStringConstantExpression(IStringConstantExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processBinaryConstantExpression(IBinaryConstantExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processRecordExpression(IRecordExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        if (null !== $expression->getDeclaredType()) {
            $this->visitTypeReference($expression->getDeclaredType());
        }

        $this->visitPropertyConstructors($expression->getProperties());
        $this->endElement($expression, __METHOD__);
    }

    protected function processPropertyReferenceExpression(IPropertyReferenceExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        if (null !== $expression->getBase()) {
            $this->visitExpression($expression->getBase());
        }
        $this->endElement($expression, __METHOD__);
    }

    protected function processPathExpression(IPathExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processParameterReferenceExpression(IParameterReferenceExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processCollectionExpression(ICollectionExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->visitExpressions($expression->getElements());
        $this->endElement($expression, __METHOD__);
    }

    protected function processLabeledExpressionReferenceExpression(
        ILabeledExpressionReferenceExpression $expression
    ): void {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processIsTypeExpression(IIsTypeExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->visitTypeReference($expression->getType());
        $this->visitExpression($expression->getOperand());
        $this->endElement($expression, __METHOD__);
    }

    protected function processIntegerConstantExpression(IIntegerConstantExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processIfExpression(IIfExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->visitExpression($expression->getTestExpression());
        $this->visitExpression($expression->getTrueExpression());
        $this->visitExpression($expression->getFalseExpression());
        $this->endElement($expression, __METHOD__);
    }

    protected function processFunctionReferenceExpression(IFunctionReferenceExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processFunctionApplicationExpression(IApplyExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->visitExpression($expression->getAppliedFunction());
        $this->visitExpressions($expression->getArguments());
        $this->endElement($expression, __METHOD__);
    }

    protected function processFloatingConstantExpression(IFloatingConstantExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processGuidConstantExpression(IGuidConstantExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processEnumMemberReferenceExpression(IEnumMemberReferenceExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processEntitySetReferenceExpression(IEntitySetReferenceExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processDecimalConstantExpression(IDecimalConstantExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processDateTimeConstantExpression(IDateTimeConstantExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processDateTimeOffsetConstantExpression(IDateTimeOffsetConstantExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processTimeConstantExpression(ITimeConstantExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processBooleanConstantExpression(IBooleanConstantExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }

    protected function processAssertTypeExpression(IAssertTypeExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->visitTypeReference($expression->getType());
        $this->visitExpression($expression->getOperand());
        $this->endElement($expression, __METHOD__);
    }

    protected function processLabeledExpression(ILabeledExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->visitExpression($expression->getExpression());
        $this->endElement($expression, __METHOD__);
    }

    protected function processPropertyConstructor(IPropertyConstructor $constructor): void
    {
        EdmUtil::checkArgumentNull($constructor->getValue(), 'constructor->getValue');
        /** @var EdmModelVisitor $this */
        $this->startElement($constructor, __METHOD__);
        $this->visitExpression($constructor->getValue());
        $this->endElement($constructor, __METHOD__);
    }

    protected function processNullConstantExpression(INullExpression $expression): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($expression, __METHOD__);
        $this->processExpression($expression);
        $this->endElement($expression, __METHOD__);
    }
}
