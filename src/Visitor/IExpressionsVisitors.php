<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Visitor;

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

interface IExpressionsVisitors
{
    public function startExpression(IExpression $expression): void;
    public function endExpression(IExpression $expression): void;
    public function startStringConstantExpression(IStringConstantExpression $expression): void;
    public function endStringConstantExpression(IStringConstantExpression $expression): void;
    public function startBinaryConstantExpression(IBinaryConstantExpression $expression): void;
    public function endBinaryConstantExpression(IBinaryConstantExpression $expression): void;
    public function startRecordExpression(IRecordExpression $expression): void;
    public function endRecordExpression(IRecordExpression $expression): void;
    public function startPropertyReferenceExpression(IPropertyReferenceExpression $expression): void;
    public function endPropertyReferenceExpression(IPropertyReferenceExpression $expression): void;
    public function startPathExpression(IPathExpression $expression): void;
    public function endPathExpression(IPathExpression $expression): void;
    public function startParameterReferenceExpression(IParameterReferenceExpression $expression): void;
    public function endParameterReferenceExpression(IParameterReferenceExpression $expression): void;
    public function startCollectionExpression(ICollectionExpression $expression): void;
    public function endCollectionExpression(ICollectionExpression $expression): void;
    public function startLabeledExpressionReferenceExpression(ILabeledExpressionReferenceExpression $expression): void;
    public function endLabeledExpressionReferenceExpression(ILabeledExpressionReferenceExpression $expression): void;
    public function startIsTypeExpression(IIsTypeExpression $expression): void;
    public function endIsTypeExpression(IIsTypeExpression $expression): void;
    public function startIntegerConstantExpression(IIntegerConstantExpression $expression): void;
    public function endIntegerConstantExpression(IIntegerConstantExpression $expression): void;
    public function startIfExpression(IIfExpression $expression): void;
    public function endIfExpression(IIfExpression $expression): void;
    public function startFunctionReferenceExpression(IFunctionReferenceExpression $expression): void;
    public function endFunctionReferenceExpression(IFunctionReferenceExpression $expression): void;
    public function startFunctionApplicationExpression(IApplyExpression $expression): void;
    public function endFunctionApplicationExpression(IApplyExpression $expression): void;
    public function startFloatingConstantExpression(IFloatingConstantExpression $expression): void;
    public function endFloatingConstantExpression(IFloatingConstantExpression $expression): void;
    public function startGuidConstantExpression(IGuidConstantExpression $expression): void;
    public function endGuidConstantExpression(IGuidConstantExpression $expression): void;
    public function startEnumMemberReferenceExpression(IEnumMemberReferenceExpression $expression): void;
    public function endEnumMemberReferenceExpression(IEnumMemberReferenceExpression $expression): void;
    public function startEntitySetReferenceExpression(IEntitySetReferenceExpression $expression): void;
    public function endEntitySetReferenceExpression(IEntitySetReferenceExpression $expression): void;
    public function startDecimalConstantExpression(IDecimalConstantExpression $expression): void;
    public function endDecimalConstantExpression(IDecimalConstantExpression $expression): void;
    public function startDateTimeConstantExpression(IDateTimeConstantExpression $expression): void;
    public function endDateTimeConstantExpression(IDateTimeConstantExpression $expression): void;
    public function startDateTimeOffsetConstantExpression(IDateTimeOffsetConstantExpression $expression): void;
    public function endDateTimeOffsetConstantExpression(IDateTimeOffsetConstantExpression $expression): void;
    public function startTimeConstantExpression(ITimeConstantExpression $expression): void;
    public function endTimeConstantExpression(ITimeConstantExpression $expression): void;
    public function startBooleanConstantExpression(IBooleanConstantExpression $expression): void;
    public function endBooleanConstantExpression(IBooleanConstantExpression $expression): void;
    public function startAssertTypeExpression(IAssertTypeExpression $expression): void;
    public function endAssertTypeExpression(IAssertTypeExpression $expression): void;
    public function startLabeledExpression(ILabeledExpression $element): void;
    public function endLabeledExpression(ILabeledExpression $element): void;
    public function startPropertyConstructor(IPropertyConstructor $constructor): void;
    public function endPropertyConstructor(IPropertyConstructor $constructor): void;
    public function startNullConstantExpression(INullExpression $expression): void;
    public function endNullConstantExpression(INullExpression $expression): void;
}
